/*//funzione chiamata dalla pagina di origine
function typeVisualize(type,div){
	info=getJson(type,div,visualizer, "getdevicebytype");
}
*/

$( window ).load(function() {
	onLoadFuc();
} );

function onLoadFuc(){
			var gets = geturlvariabili();	// declared in usefulFunctions.js
			var tipo = gets['tipo'];
		/*	typeVisualize(tipo,$("#visualSmart"));*/
			mGetHeader("assistances", "mHeader");	// declared in usefulFunctions.js
			visualizer(tipo, $("#visualSmart") );
			footer("footer");
}

//funzione da usare per formattare le informazioni tirate fuori
function visualizer(info,div){
  	$.get("php/assistanceFunctions.php", {what: 'list', tipo: info}, 
  		function(data, status){
	  		div.html( data );
  	});
}