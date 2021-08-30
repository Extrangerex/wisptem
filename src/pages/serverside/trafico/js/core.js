<!--
////////////////////////////////////////////////////////////////////
// ESTE EJEMPLO SE DESCARGO DE www.tech-nico.com ///////////////////
// Creado por: Nicolas Daitsch. Guatrache. La Pampa ////////////////
// Contacto: administracion@tech-nico.com //////////////////////////
// RouterOS API: Busco Usuario PPPoE activo y muestro Graph o Log //
////////////////////////////////////////////////////////////////////

function api(url,data__,targetId,div_preload,boton){
	if (typeof(boton) == "object") { boton.disabled = true; }
	var url = url+data__;
	var params = {} ; 
	var miAjax = new Request.HTML({
		url: url,
		method: 'get',
		data: params,
		update: $(targetId),
		onRequest: function(){
			$(div_preload).set("html",'<img src="images/indicator_white_small.gif" />');
		},
		onSuccess: function(responseTree, responseElements, responseHTML, responseJavaScript){
			if (typeof(boton) == "object") { boton.disabled = false; }
			$(div_preload).set("html",'');
			$(targetId).set('html', responseHTML);
		},
		onFailure: function(){ 
			$(div_preload).set("html","Ocurrio un error.");
			$(targetId).set('html', "");
		},
		evalScripts: true
	});
	miAjax.send();
}


function enter(e){
	var k=null;
	(e.keyCode) ? k=e.keyCode : k=e.which;
	if(k==13) { return true }else{ return false }
}
-->