<?php
namespace Lib;
/*
 * + --------------------------------------------------------- +
 * |  Software:	Paginador - clase PHP para paginar registros   |
 * |   Versi�n:	1.0					       |
 * |  Licencia:	Distribuido de forma libre		       |
 * |     Autor:	Jaisiel Delance				       |
 * | Sitio Web:	http://www.dlancedu.com	                       |
 * + --------------------------------------------------------- +
 *
 */
class Paginador
{
    private $_datos;
    private $_paginacion;
    
    public function __construct() {
        $this->_datos = array();
        $this->_paginacion = array();
    }
    
    public function getPages(){
        return $this->_paginacion;
    }

    public function paginar($query, $xpagina = false, $xlimite = 10) {
        $limite= ($xlimite && is_numeric($xlimite)) ? $xlimite : 10;
        $pagina = ($xpagina && is_numeric($xpagina)) ? $xpagina : 1; 
        $inicio = ($xpagina && is_numeric($xpagina)) ? ($pagina - 1) * $limite : 0;
        $registros = count($query);
        $total = ceil($registros / $limite);
        $paginacion = array('actual' => $pagina , 'total' => $total);
        if($pagina > 1){
            $paginacion['primero'] = 1;
            $paginacion['anterior'] = $pagina - 1;
        } else {
            $paginacion['primero'] = '';
            $paginacion['anterior'] = '';
        }        
        if($pagina < $total){
            $paginacion['ultimo'] = $total;
            $paginacion['siguiente'] = $pagina + 1;
        } else {
            $paginacion['ultimo'] = '';
            $paginacion['siguiente'] = '';
        }
        $this->_paginacion = $paginacion;
	$this->_rangoPaginacion($paginacion);        
        return array_slice($query, $inicio, $limite);
    }
    
    private function _rangoPaginacion($xlimite = false) {
        $limite= ($xlimite && is_numeric($xlimite)) ? $xlimite : 10;        
        $total_paginas = $this->_paginacion['total'];
        $pagina_seleccionada = $this->_paginacion['actual'];
        $rango = ceil($limite / 2);
        $paginas = array();        
        $rango_derecho = $total_paginas - $pagina_seleccionada;
        $resto=($rango_derecho < $rango) ? $rango - $rango_derecho : 0 ;       
        $rango_izquierdo = $pagina_seleccionada - ($rango + $resto);       
        for($i = $pagina_seleccionada; $i > $rango_izquierdo; $i--){
            if($i == 0){
                break;
            }            
            $paginas[] = $i;
        }        
        sort($paginas);      
        if($pagina_seleccionada < $rango){
            $rango_derecho = $limite;
        } else {
            $rango_derecho = $pagina_seleccionada + $rango;
        }       
        for($i = $pagina_seleccionada + 1; $i <= $rango_derecho; $i++){
            if($i > $total_paginas){
                break;
            }
            
            $paginas[] = $i;
        }
        $this->_paginacion['rango'] = $paginas;        
        return $this->_paginacion;        
    }
}
?>