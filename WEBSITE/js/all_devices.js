/*//funzione chiamata dalla pagina di origine
function typeVisualize(type,div){
	info=getJson(type,div,visualizer, "getdevicebytype");
}
*/
$(document).bind("mobileinit", function () {
 $.support.cors = true;
 $.mobile.allowCrossDomainPages = true; });



$( window ).load(function() {
	onLoadFuc();
} );

function onLoadFuc(){
			var gets = geturlvariabili();	// declared in usefulFunctions.js
			var tipo = gets['tipo'];
		/*	typeVisualize(tipo,$("#visualSmart"));*/
			mGetHeader("devices", "mHeader");	// declared in usefulFunctions.js
			visualizer(tipo, $("#visualSmart") );
			footer("footer");
}

//funzione da usare per formattare le informazioni tirate fuori
function visualizer(info,div){
  	$.get("http://hyp65.altervista.org/php/deviceFunctions.php", {what: 'list', tipo: info}, 
  		function(data, status){
	  		div.html( data );
  	});
}