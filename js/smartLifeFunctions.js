$( window ).load(function() {
	onLoadFuc();
} );

function onLoadFuc(){
			var gets = geturlvariabili();	// declared in usefulFunctions.js
            alert("id:"+deviceID);
			var fromDevice = gets['fromDevice'];
			var deviceID = gets['deviceId'];
            var deviceName = gets['deviceName'];
            if(fromDevice==1)
				visualizer('backToDevice',deviceID,deviceName);
}

function visualizer(div,deviceID,deviceName){
	  		$('#'+div).html("<button type='button' class='btn btn-primary' onclick=\"location.href='device.html?id="+deviceID+"'\">Back to "+deviceName+"</button> ");
}