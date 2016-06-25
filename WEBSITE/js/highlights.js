$(document).bind("mobileinit", function () {
 $.support.cors = true;
 $.mobile.allowCrossDomainPages = true; });


$(document).ready( function(){
	mOnDocumentReady();
});

function mOnDocumentReady(){
	mGetHeader("highlights", "mHeader");
	getHighlightsAssistances("visualSmart");
	footer("footer");

}

function getHighlightsAssistances(divName){
	$.get("http://hyp65.altervista.org/php/highlightsFunctions.php", {}, function(data, status){
		document.getElementById(divName).innerHTML = data;
	});
}
