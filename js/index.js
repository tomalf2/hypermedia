$(document).bind("mobileinit", function () {
 $.support.cors = true;
 $.mobile.allowCrossDomainPages = true; });

$(document).ready( function(){
	mOnDocumentReady();
});

function mOnDocumentReady(){
	mGetHeader("home", "mHeader");
	getPromotionDevices("tab_group1", "smartphone", 3);
	getPromotionServices("tab_group2", 3);
	getPromotionDevices("tab_group3", "tablet", 3);
	footer("footer");

}


function getPromotionDevices(div, ofType, limit){
	$.get("/php/promotionFunctions.php", {what: 'devices_not_sl', tipo: ofType, limit: limit}, function(data, status){
		document.getElementById(div).innerHTML = data;
	});
}

function getPromotionServices(div, limit){
	$.get("/php/promotionFunctions.php", {what: 'services_and_sl_devices', limit: limit}, function(data, status){
		document.getElementById(div).innerHTML = data;
	})
}
