/* Add here all your JS customizations */

jQuery(document).ready(function($) {
    var msj = $(".mensaje")
    if (msj.text()!="") {
        new PNotify({
			title: 'Mensaje',
			text: msj.text(),
			type: 'custom',
			addclass: 'notification-success',
			icon: 'fas fa-check-circle'
		});
    }
   
	

});