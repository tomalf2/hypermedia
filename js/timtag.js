$( window ).load(function() {
	onLoadFuc();
} );

function onLoadFuc(){
    var gets = geturlvariabili();	// declared in usefulFunctions.js
    var fromDevice = gets['fromDevice'];
    var deviceID = gets['deviceId'];
    var deviceName = decodeURIComponent(gets['deviceName']);
	mGetHeader("smartlife", "mHeader");	// declared in usefulFunctions.js
	footer("footer");
     if(fromDevice==1)
				visualizer('backToDevice',deviceID,deviceName);
}

function visualizer(div,deviceID,deviceName){
	  		$('#'+div).html("<button type='button' class='btn btn-primary' onclick=\"location.href='device.html?id="+deviceID+"'\">Back to "+deviceName+"</button> ");
}