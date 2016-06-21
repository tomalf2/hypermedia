$( window ).load(function() {
	onLoadFuc();
} );

function onLoadFuc(){
			var gets = geturlvariabili();	// declared in usefulFunctions.js
			var deviceID = gets['id'];
			var deviceType = gets['tipo'];
            var order = gets['order'];
            var fromPromotion = gets['fromPromotion'];
            var fromHome = gets['fromHome'];
            var fromAssistance = gets['fromAssistance'];
            var assistanceID = gets['assistanceId'];
            var assistanceName = gets['assistanceName'];
		/*	typeVisualize(deviceID,$("#visualSmart"));*/
			mGetHeader("devices", "mHeader");	// declared in usefulFunctions.js
			visualizer(deviceID, "visualSmart",fromPromotion,fromHome,fromAssistance ,assistanceID ,assistanceName ,order);
			//getRelatedProducts(deviceID, deviceType, $("#relatedProducts") );
      footer("footer");
}

//funzione da usare per formattare le informazioni tirate fuori
function visualizer(deviceID,div,fromPromotion,fromHome,fromAssistance, assistanceID ,assistanceName ,order){
    $.get("php/deviceFunctions.php", {what: 'device', id: deviceID,fromPromotion : fromPromotion,fromHome:fromHome,fromAssistance :fromAssistance ,order : order,assistanceID:assistanceID,assistanceName:assistanceName}, 
  		function(data, status){
	  		$('#'+div).html( data );
  	});
}

function getRelatedProducts(deviceID, deviceType, div){
  	$.get("php/deviceFunctions.php", {what: 'rel', id: deviceID, tipo: deviceType, limit: 3}, 
  		function(data, status){
	  		div.html( data );
  	});
 }

function getRelatedAssistance(deviceID,deviceName,deviceType,div){ 
	$.get("php/deviceFunctions.php", {what: 'relatedAssistance', id: deviceID, name : deviceName, tipo: deviceType}, 
  		function(data, status){
        	$('#'+div).html( data );
  	});
}
 
 
function getRelatedAssistance(assistanceID,assistanceName,assistanceType,div){ 
	$.get("php/deviceFunctions.php", {what: 'relatedAssistance', id: assistanceID, name : assistanceName, tipo: assistanceType}, 
  		function(data, status){
        	$('#'+div).html( data );
  	});
}