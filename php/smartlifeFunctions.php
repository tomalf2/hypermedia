</head>
<body>
<?php
	include'database.php';

	//choose what to do
	$what = $_GET['what'];

	$ofType = $_GET['tipo'];
	$deviceID = $_GET['id'];
	$limitRelatedProducts = $_GET['limit'];

	switch ($what) {
		case 'related':
			getSLRelatedTo($deviceID);
			break;	
		default:
			echo "javascript did not called the right function, check you have set the right what parameter";
			break;
	}


	function getSLRelatedTo($deviceID){

		$array = get
	}

?>