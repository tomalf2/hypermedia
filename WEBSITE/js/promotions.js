$(document).bind("mobileinit", function () {
 $.support.cors = true;
 $.mobile.allowCrossDomainPages = true; });


$(document).ready( function(){
	mOnDocumentReady();
});

function mOnDocumentReady(){
	var gets = geturlvariabili();	// declared in usefulFunctions.js
	var tipo = gets['tipo'];
	mGetHeader("promotions", "mHeader");
  if(tipo=='smart')
		getPromotionServices("visualSmart");
	else
		getPromotionDevices("visualSmart",tipo);
    footer("footer");
}

function getPromotionDevicesOrderBy(divName,type){
    var orderBy="";
      switch(type){
          case 'costo':
               orderBy=" Price";
                $.get("http://hyp65.altervista.org/php/promotionFunctions.php", {what: 'devices',ordine:"costo"}, function(data, status){
                 document.getElementById(divName).innerHTML = data;
              });
             break;
          case 'smartphone':
              orderBy=" Smartphone";
              $.get("http://hyp65.altervista.org/php/promotionFunctions.php", {what: 'devices',ordine:"costo",tipo:"smartphone"}, function(data, status){
                document.getElementById(divName).innerHTML = data;
             });
          break;
          case 'tablet':
              orderBy=" Tablets";
              $.get("http://hyp65.altervista.org/php/promotionFunctions.php", {what: 'devices',ordine:"costo",tipo:"tablet"}, function(data, status){
                document.getElementById(divName).innerHTML = data;
            });
          break;
          case 'modem':
              orderBy=" Networking";
              $.get("http://hyp65.altervista.org/php/promotionFunctions.php", {what: 'devices',ordine:"costo",tipo:"modem"}, function(data, status){
                document.getElementById(divName).innerHTML = data;
            });
          break;
          case 'smartLiving':
              orderBy=" SmartDevices";
              $.get("http://hyp65.altervista.org/php/promotionFunctions.php", {what: 'devices',ordine:"costo",tipo:"smartLiving"}, function(data, status){
                document.getElementById(divName).innerHTML = data;
            });
          break;
      }

}


function getPromotionDevices(divName,tipo){
	var type;
    if(tipo!=null)
    	type = tipo;
    else
    	type='';
	$.get("http://hyp65.altervista.org/php/promotionFunctions.php", {what: 'devices',tipo:type}, function(data, status){
		document.getElementById(divName).innerHTML = data;
	});
}

function getPromotionServices(divName){
	$.get("http://hyp65.altervista.org/php/promotionFunctions.php", {what: 'services'}, function(data, status){
		document.getElementById(divName).innerHTML = data;
	})
}
