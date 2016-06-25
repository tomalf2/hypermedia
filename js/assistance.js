$(document).bind("mobileinit", function () {
 $.support.cors = true;
 $.mobile.allowCrossDomainPages = true; });


$( window ).load(function() {
	onLoadFuc();
} );

function onLoadFuc(){
			var gets = geturlvariabili();	// declared in usefulFunctions.js
			var assistanceID = gets['id'];
			var deviceType = gets['tipo'];
            var fromHighlights = gets['fromHighlights'];
            var fromDevice = gets['fromDevice'];
            var deviceID = gets['deviceId'];
            var deviceName = gets['deviceName'];
			mGetHeader("assistance", "mHeader");	// declared in usefulFunctions.js
			visualizer(assistanceID,'visualSmart',fromHighlights,fromDevice,deviceID,deviceName);
      footer("footer");

}

//funzione da usare per formattare le informazioni tirate fuori
function visualizer(assistanceID,div,fromHighlights,fromDevice,deviceID,deviceName){
  	$.get("http://hyp65.altervista.org/php/assistanceFunctions.php", {what: 'assistance', id: assistanceID, fromHighlights : fromHighlights, fromDevice : fromDevice, deviceID : deviceID , deviceName:deviceName}, 
  		function(data, status){
	  		 $('#'+div).html( data );
  	});
}

function getRelatedProducts(assistanceID,assistanceName,assistanceType,div){
	$.get("http://hyp65.altervista.org/php/assistanceFunctions.php", {what: 'relatedProducts', id: assistanceID, tipo: assistanceType,name: assistanceName}, 
  		function(data, status){
        	$('#'+div).html( data );
  	});
}