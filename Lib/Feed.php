 
<?php
/**
 * RSS para PHP - libreria simple y facil de usars para leer RSS Feed
 *
 * @copyright  Copyright (c) 2016 Cardosoft & David Grudl
 * @license    New BSD License
 * @version    1.2
 */
class Feed
{
	/** @var int */
	public static $cacheExpire = '5 day';
	/** @var string */
	public static $cacheDir;
	/** @var SimpleXMLElement */
	protected $xml;
	/**
	 * Carga RSS o Atom feed.
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return Feed
	 * @throws FeedException
	 */
	public static function load($url, $user = NULL, $pass = NULL)
	{
		$xml = self::loadXml($url, $user, $pass);
		if ($xml->channel) {
			return self::fromRss($xml);
		} else {
			return self::fromAtom($xml);
		}
	}
	/**
	 * Carga RSS feed.
	 * @param  string  RSS feed URL
	 * @param  string  opcional Nombre de usuario
	 * @param  string  opcional contraseña
	 * @return Feed
	 * @throws FeedException
	 */
	public static function loadRss($url, $user = NULL, $pass = NULL)
	{
		return self::fromRss(self::loadXml($url, $user, $pass));
	}
	/**
	 * Carga Atom feed.
	 * @param  string  Atom feed URL
	 * @param  string  opcional Nombre de usuario
	 * @param  string  opcional contraseña
	 * @return Feed
	 * @throws FeedException
	 */
	public static function loadAtom($url, $user = NULL, $pass = NULL)
	{
		return self::fromAtom(self::loadXml($url, $user, $pass));
	}
	private static function fromRss(SimpleXMLElement $xml)
	{
		if (!$xml->channel) {
			throw new FeedException('Feed nvalida.');
		}
		self::adjustNamespaces($xml);
		foreach ($xml->channel->item as $item) {
			// Convierte namespaces en etiquetas con puntos
			self::adjustNamespaces($item);
			// genera la etiqueta 'timestamp'
			if (isset($item->{'dc:date'})) {
				$item->timestamp = strtotime($item->{'dc:date'});
			} elseif (isset($item->pubDate)) {
				$item->timestamp = strtotime($item->pubDate);
			}
		}
		$feed = new self;
		$feed->xml = $xml->channel;
		return $feed;
	}
	private static function fromAtom(SimpleXMLElement $xml)
	{
		if (!in_array('http://www.w3.org/2005/Atom', $xml->getDocNamespaces(), TRUE)
			&& !in_array('http://purl.org/atom/ns#', $xml->getDocNamespaces(), TRUE)
		) {
			throw new FeedException('Feed invalida.');
		}
		// genera la etiqueta 'timestamp'
		foreach ($xml->entry as $entry) {
			$entry->timestamp = strtotime($entry->updated);
		}
		$feed = new self;
		$feed->xml = $xml;
		return $feed;
	}
	/**
	 * Da el valor de la propiedad. No directamente.
	 * @param  string  tag name
	 * @return SimpleXMLElement
	 */
	public function __get($name)
	{
		return $this->xml->{$name};
	}
	/**
	 * Asigna el valor de la propiedad. No directamente.
	 * @param  string  property name
	 * @param  mixed   property value
	 * @return void
	 */
	public function __set($name, $value)
	{
		throw new Exception("No se puede asignar sobre una propiedad de solo lectura '$name'.");
	}
	/**
	 * Convierte a SimpleXMLElement en array.
	 * @param  SimpleXMLElement
	 * @return array
	 */
	public function toArray(SimpleXMLElement $xml = NULL)
	{
		if ($xml === NULL) {
			$xml = $this->xml;
		}
		if (!$xml->children()) {
			return (string) $xml;
		}
		$arr = array();
		foreach ($xml->children() as $tag => $child) {
			if (count($xml->$tag) === 1) {
				$arr[$tag] = $this->toArray($child);
			} else {
				$arr[$tag][] = $this->toArray($child);
			}
		}
		return $arr;
	}
	/**
	 * Carga XML desde cache o HTTP.
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return SimpleXMLElement
	 * @throws FeedException
	 */
	private static function loadXml($url, $user, $pass)
	{
		$e = self::$cacheExpire;
		$cacheFile = self::$cacheDir . '/feed.' . md5(serialize(func_get_args())) . '.xml';
		if (self::$cacheDir
			&& (time() - @filemtime($cacheFile) <= (is_string($e) ? strtotime($e) - time() : $e))
			&& $data = @file_get_contents($cacheFile)
		) {
			// ok
		} elseif ($data = trim(self::httpRequest($url, $user, $pass))) {
			if (self::$cacheDir) {
				file_put_contents($cacheFile, $data);
			}
		} elseif (self::$cacheDir && $data = @file_get_contents($cacheFile)) {
			// ok
		} else {
			throw new FeedException('No se puede cargar el feed de las noticias, intente de nuevo.');
		}
		return new SimpleXMLElement($data, LIBXML_NOWARNING | LIBXML_NOERROR);
	}
	/**
	 * Procesa la consulta HTTP.
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return string|FALSE
	 * @throws FeedException
	 */
	private static function httpRequest($url, $user, $pass)
	{
		if (extension_loaded('curl')) {
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			if ($user !== NULL || $pass !== NULL) {
				curl_setopt($curl, CURLOPT_USERPWD, "$user:$pass");
			}
			curl_setopt($curl, CURLOPT_HEADER, FALSE);
			curl_setopt($curl, CURLOPT_TIMEOUT, 20);
			curl_setopt($curl, CURLOPT_ENCODING , '');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); // sin echo, solo da el valor
			if (!ini_get('open_basedir')) {
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE); // spuede servir
			}
			$result = curl_exec($curl);
			return curl_errno($curl) === 0 && curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200
				? $result
				: FALSE;
		} elseif ($user === NULL && $pass === NULL) {
			return file_get_contents($url);
		} else {
			throw new FeedException('La extension CURL de PHP CURL no esta cargada.');
		}
	}
	/**
	 * Genera mejores etiquetas de acceso para el namespace.
	 * @param  SimpleXMLElement
	 * @return void
	 */
	private static function adjustNamespaces($el)
	{
		foreach ($el->getNamespaces(TRUE) as $prefix => $ns) {
			$children = $el->children($ns);
			foreach ($children as $tag => $content) {
				$el->{$prefix . ':' . $tag} = $content;
			}
		}
	}
}
/**
 * Excepcion generada por Feed.
 */
class FeedException extends Exception
{
}
