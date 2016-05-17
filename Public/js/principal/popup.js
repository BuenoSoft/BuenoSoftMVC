    if (window.addEventListener) {
        window.addEventListener("keydown", compruebaTecla, false);
    } else if (document.attachEvent) {
        document.attachEvent("onkeydown", compruebaTecla);
    }
    function compruebaTecla(evt){
        var tecla = evt.which || evt.keyCode;
        if(tecla == 27){
             document.getElementById("popup").style.display = "none";
        }
    }
$(document).ready(function() {
	
	$('.mybutton').click(function() {
		
		type = $(this).attr('data-type');
		
		$('.overlay-container').fadeIn(function() {
			
			window.setTimeout(function(){
				$('.window-container.'+type).addClass('window-container-visible');
			}, 100);
			
		});
	});
	
	$('.close').click(function() {
		$('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
	});
	
});

 

