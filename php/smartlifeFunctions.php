</head>
<body>
<?php
	header('Access-Control-Allow-Origin: *');
	include'database.php';

	//choose what to do
	$what = $_GET['what'];

	$ofType = $_GET['tipo'];
	$id = $_GET['id'];
	$limitRelatedProducts = $_GET['limit'];

	switch ($what) {
		case 'devsOfService':
			getDevsOfService($id);
			break;
		case 'breadcrumb':
			getBreadcrumb($id);
			break;	
		default:
			echo "javascript did not called the right function, check you have set the right what parameter";
			break;
	}


	function getDevsOfService($smartlifeID){

		
		$array = getProductsBySmartLifeID($smartlifeID);

		echo "<div class=\"container-fluid text-center\">    
				  <div class=\"row content\">";

				  //barra laterale sinistra
		echo 		"<div class=\"col-sm-2 sidenav\">
       				<br><br>
				    <a href=\"".getSmartInfoId($smartlifeID)[SL_LINK]."\" class=\"btn btn-primary\">Vai alla pagina del servizio</a>
				    </div>";
				   // fine barra laterale

		echo "<div id=\"spazio_centrale\" class=\"col-sm-8 text-left\"> ";

		$tot = sizeof($array);
		$colWidth = round(12/$tot, 0, PHP_ROUND_HALF_DOWN);
	 
	 	$i=0;
		while($i < sizeof($array) ){
			echo "<div class=\"row content\">";
			for($j = 0; $j < 3 && $i+$j<$tot; $j++){

				echo "<div class=\"col-xs-".$colWidth."\">
						<a href=\"device.html?id=".$array[$i+$j][DEV_ID]."&fromSmartLife=1&smartLifeID=".$smartlifeID."&smartLifeName=".getSmartInfoId($smartlifeID)[SL_NAME]."\">
							<img class=\"img-responsive\" src=\"./img/devices/".$array[$i+$j][DEV_MODEL].".jpg\">
							<!-- nome telefono -->
							<center>
							<p>".$array[$i+$j][DEV_NAME]."</p>
							</center>
						</a>
					</div>";
			}
			// chiude row-content
			echo "</div>";
			$i = $i+$j;
		}

		echo "</div>"; // chiude il div con id spazio_centrale
	    	
	    	//barra laterale destra
		echo "<div class=\"col-sm-2 sidenav\">
			  </div>";
			  // fine barra laterla destra

			  //chiude il container fluid ed il row-content iniziale
		echo "</div>
			</div>";
	}


	function getBreadcrumb($smartlifeID){

		$array = getSmartInfoId($smartlifeID);
		$name = $array[SL_NAME];
		$link = $array[SL_LINK];

		$family = $array[SL_FAMILY];
		$familyLink = $array[SL_FAMILY_LINK];

		echo "<p id=\"brcrumb\"><a href=\"all_category_smartlife.html\">Smartlife</a> > <a href=\"".$familyLink."\">".$family."</a> > <a href=\"".$link."\">".$name."</a> > Dispositivi compatibili</p>";
	}

	
?>