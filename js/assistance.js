$( window ).load(function() {
	onLoadFuc();
} );

function onLoadFuc(){
			var gets = geturlvariabili();	// declared in usefulFunctions.js
			var deviceID = gets['id'];
			var deviceType = gets['tipo'];
            var fromHighlights = gets['fromHighlights'];
            var fromPhone = gets['fromPhone'];
            var phoneID = gets['phoneId'];
            var phoneName = gets['phoneName'];
			mGetHeader("assistance", "mHeader");	// declared in usefulFunctions.js
			visualizer(deviceID,'visualSmart',fromHighlights,fromPhone,phoneID,phoneName);
      footer("footer");

}

//funzione da usare per formattare le informazioni tirate fuori
function visualizer(assistanceID,div,fromHighlights,fromPhone,phoneID,phoneName){
  	$.get("php/assistanceFunctions.php", {what: 'assistance', id: assistanceID, fromHighlights : fromHighlights, fromPhone : fromPhone, phoneID : phoneID , phoneName:phoneName}, 
  		function(data, status){
	  		 $('#'+div).html( data );
  	});
}

function getRelatedProducts(assistanceID,assistanceName,assistanceType,div){
	$.get("php/assistanceFunctions.php", {what: 'relatedProducts', id: assistanceID, tipo: assistanceType,name: assistanceName}, 
  		function(data, status){
        	$('#'+div).html( data );
  	});
}