$(document).bind("mobileinit", function () {
 $.support.cors = true;
 $.mobile.allowCrossDomainPages = true; });


$( window ).load(function() {
	onLoadFuc();
} );

function onLoadFuc(){
	mGetHeader("aboutus", "mHeader");
	footer("footer");
}