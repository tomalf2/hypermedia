$(document).bind("mobileinit", function () {
 $.support.cors = true;
 $.mobile.allowCrossDomainPages = true; });


$( window ).load(function() {
	onLoadFuc();
} );

function onLoadFuc(){
	mGetHeader("smartlife", "mHeader");
	footer("footer");
}

$(window).resize( function() {
	if( $(window).width() > 417 && $(window).width() <500 )
		document.getElementById('casaefamiglia').innerHTML = 'Casa<br>e Famiglia';
	else
		document.getElementById('casaefamiglia').innerHTML = 'Casa e Famiglia';
});