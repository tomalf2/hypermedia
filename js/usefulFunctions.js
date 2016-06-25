$(document).bind("mobileinit", function () {
 $.support.cors = true;
 $.mobile.allowCrossDomainPages = true; });


// fill targetDiv with the header.php contents adapted to current page 
function mGetHeader(currentPageName, targetDiv) {
	var parametri = {};
	parametri["pagina"] = currentPageName;
  	$.get("http://hyp65.altervista.org/php/header.php", parametri, function(data, status){
  	  	document.getElementById(targetDiv).innerHTML = data;
  	  	console.log(status);
  	});
}

$(document).click(function (event) {
    var clickover = $(event.target);
    console.log( clickover );
    var $navbar = $(".navbar-collapse");               
    var _opened = $navbar.hasClass("in");
    if (_opened === true ) {      
        $navbar.collapse('hide');
    }
});


//chiamata json, callback serve per poter utilizzare la variabile result quando è pronta e non prima in quanto essendo una 
//chiamata asincrona l'assegnamento immediato di result a una varibile di ritorno equivale ad assegnare null
//getWhat assume i valori getservicebytype, getdevicebytype

/////  ./DATABASE.PHP HAS TO RENAMED IN PHP/DATABASE.PHP  !!!!!!!!!    ///////////////////////////////////////////////////////
// now the database.php called is that one in root folder
function getJson(type,div,callbackFunction,getWhat){
	$.getJSON("http://hyp65.altervista.org/php/database.php",{function:getWhat,tipo:type},function(result){
	callbackFunction(result,div);
  	});
}


function geturlvariabili() {		
		var vars = new Array();
		var url = window.location.href;
        if(url.indexOf('?')==-1)
        	return vars;
		var pezzi = url.split('?');
		var variabili = pezzi[1].split('&');
		for(i=0;i<variabili.length;i++){
				vars[variabili[i].split('=')[0]]=variabili[i].split('=')[1];
				}
		return vars;
}


function breadcrumb(div){
	var url = window.location.href;
	
	var pageName = url;
	for(var i=0; i<3; i++ ){
		pageName = pageName.substring( pageName.indexOf('/') +1 );
	}
	var pageNameEndAt = pageName.indexOf(".");
	var pageName = pageName.substr( 0, pageNameEndAt);

	console.log(pageName);
	$.get("http://hyp65.altervista.org/php/breadcrumb.php", {pageName: pageName, url: url}, function(data, status){
		document.getElementById(div).innerHTML = data;
	});
}


function footer(div){
	$("#"+div).load("http://hyp65.altervista.org/php/footer.php");
}

