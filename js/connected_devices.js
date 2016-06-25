$(document).bind("mobileinit", function () {
 $.support.cors = true;
 $.mobile.allowCrossDomainPages = true; });


$( window ).load(function() {
	onLoadFuc();
} );

function onLoadFuc(){
	mGetHeader("smartlife", "mHeader");	// declared in usefulFunctions.js
	footer("footer");

	var gets = geturlvariabili();	// declared in usefulFunctions.js
	var smartlifeID = gets['id'];
	getBreadcrumb("breadcrumb", smartlifeID);
	getDeviceList("visualSmart", smartlifeID);
}


function getDeviceList(div, smartlifeID){
	$.get("http://hyp65.altervista.org/php/smartlifeFunctions.php", {what: 'devsOfService', id: smartlifeID}, 
  		function(data, status){
	  		$('#'+div).html( data );
  	});
}

function getBreadcrumb(div, smartlifeID){
	$.get("http://hyp65.altervista.org/php/smartlifeFunctions.php", {what: 'breadcrumb', id: smartlifeID}, 
  		function(data, status){
	  		$('#'+div).html( data );
  	});
}
