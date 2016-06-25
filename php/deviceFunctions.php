<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	header('Access-Control-Allow-Origin: *');
	include'database.php';


	//choose what to do
	$what = $_GET['what'];

	$ofType = $_GET['tipo'];
	$deviceID = $_GET['id'];
    $deviceName = $_GET['name'];
    $fromPromotion = $_GET['fromPromotion'];
    $fromHome = $_GET['fromHome'];
    $fromAssistance = $_GET['fromAssistance'];
    $order = $_GET['order'];
    $assistanceID =$_GET['assistanceID'];
    $assistanceName = $_GET['assistanceName'];
    $smartLifeID = $_GET['smartLifeID'];
    $fromSmartLife = $_GET['fromSmartLife'];
    $smartLifeName= $_GET['smartLifeName'];
	$limitRelatedProducts = $_GET['limit'];
	switch ($what) {
		case 'device':
			getDeviceOfId($deviceID,$fromPromotion,$fromHome,$fromAssistance,$fromSmartLife,$smartLifeID,$smartLifeName,$order,$assistanceID,$assistanceName);
            break;
		case 'rel':
			getProductsRelated($deviceID, $ofType, $limitRelatedProducts);
			break;
		case 'list':
			getDevices($ofType);
			break;	
        case 'relatedAssistance':
        	getAssistances($deviceID,$ofType,$deviceName);
			break;	
        case 'relatedSmartLife':
        	getSmartLifes($deviceID,$ofType,$deviceName);
			break;	
		default:
			echo "javascript did not called the right function, check you have set the right what parameter";
			break;
	}



	//declared_functions
	function getDeviceOfId($deviceID,$fromPromotion,$fromHome, $fromAssistance,$fromSmartLife,$smartLifeID,$smartLifeName,$order,$assistanceID,$assistanceName){
		$array = getProductInfoId($deviceID);
		
        $numberOfRelatedAssistances=sizeof(getAssistancesByDevID($deviceID));
        
        $numberOfRelatedSmart=sizeof(getSmartLifeByDevID($deviceID));
        
		// breadcrumb
		$breadcrumb = "<div id=\"mBreadcrumb\">
			<span id=\"title\">
				<a href=\"all_category_devices.html\">Dispositivi
				</a> > 
				<a href=\"all_devices.html?tipo=".$array[DEV_TYPE]."\" >".$array[DEV_TYPE]."
				</a> 
			</span>
			>
			<span id=\"item_not_clickable\">".$array[DEV_NAME]."</span>
			</div>";
		echo $breadcrumb;
		// end


		echo "<div style=\"margin-top:15px\" class=\"container-fluid text-center\">    
				  <div class=\"row content\">";

				  //barra laterale sinistra
		echo 		"<div class=\"col-sm-2 sidenav\">
        			<br><br>";
                    echo"<a href=\"all_devices.html?tipo=".$array[DEV_TYPE]."\" class=\"btn btn-primary\">Go to ".$array[DEV_TYPE]."</a><br><br>";
                    if($fromPromotion==1)
                    	echo"<a href=\"promotions.html?tipo=".$array[DEV_TYPE]."\" class=\"btn btn-primary\">Back to Promotions</a>";
                    else{
                    	if($fromHome==1)
                        	echo"<a href=\"index.html\" class=\"btn btn-primary\">Back to Home</a>";
                        else{
                            if($fromAssistance==1){
                                echo"<a href=\"assistance.html?id=".$assistanceID."\" class=\"btn btn-primary\">Back to ";
                                if(strlen(urldecode($assistanceName))> 14)
                                	echo ''.substr(urldecode($assistanceName),0,14)."...</a>";
                                else
                                	echo ''.urldecode($assistanceName)."</a>";
                                }       
                            else
                            	if($fromSmartLife==1){
                                $link=getSmartLinkFromId($smartLifeID);
                                 echo"<a href='".$link."' class=\"btn btn-primary\">Back to ";
                                if(strlen(urldecode($smartLifeName))> 14)
                                	echo ''.substr(urldecode($smartLifeName),0,14)."...</a>";
                                else
                                	echo ''.urldecode($smartLifeName)."</a>";
                                }
                     	}
                     }
                    echo"<br><br>
        			  <a onclick=\"getRelatedAssistance(".$array[DEV_ID].",'".$array[DEV_NAME]."','".$array[DEV_TYPE]."','visualSmart')\" class=\"btn btn-primary";
                      if( $numberOfRelatedAssistances < 1)
                        	echo " disabled";
                      echo "\">Assistenza</a> <br><br>
                      <a onclick=\"relatedSmartLife(".$array[DEV_ID].",'".$array[DEV_NAME]."','".$array[DEV_TYPE]."','visualSmart')\" class=\"btn btn-primary";
                      if( $numberOfRelatedSmart < 1)
                        	echo " disabled";
                      echo "\">Smart Life </a>
				    </div>";
				   // fine barra laterale

		echo "<div id=\"spazio_centrale\" class=\"col-sm-8 text-left\">";
			//nuiva riga
			echo "<div class=\"row content\">";

					echo "<div class=\"col-xs-6\">
							<img class=\"img-responsive\" src=\"./img/devices/".$array[DEV_MODEL].".jpg\">
						</div>
						
						<div class=\"col-xs-6\">
							<h1 id=\"name\">".$array[DEV_NAME]."</h1>
							<br>
							<br>
							<h3 id=\"short_desc_title\">Caratteristiche</h3>
							<br>
							<h4 id=\"short_desc\">".$array[DEV_SHORT_DESC]."</h4>
							<a id=\"buy\" href=\"#\"><h3>Acquistalo online a ".$array[DEV_PRICE]." €</h3></a>
						</div>";
			// chiudi  riga						
			echo "</div>";
			
			//nuova riga
			echo "<div class=\"row content\">";
				echo "<div class=\"col-xs-12\">
						
						<p id=\"long_desc\">".$array[DEV_LONG_DESC]."</p>
						<br>
						<h4 id=\"features_title\">Caratteristiche</h4>
						<p id=\"features\">".$array[DEV_FEATURES]."</p>
					</div>";
			// chiudi  riga						
			echo "<div>";
			
		echo "</div>"; // chiude il div con #spazio_centrale

			//barra laterale destra
		echo "<div class=\"col-sm-2 sidenav\">
			     <!--  <div class=\"well\">
			        <p>ADS</p>
			      </div> -->
			      <!-- <div class=\"well\">
			        <p>ADS</p>
			      </div> -->
			  </div>";
			  // fine barra laterla destra

			  //chiude il container fluid ed il row-content iniziale
		echo "</div>
			</div>";
	}



	function getDevices($categoryOfDevice) {

		$array = getInfoByTypeAndTable($categoryOfDevice,TABLE_PRODUCTS);


		// breadcrumb
		$breadcrumb = "
			<div id=\"mBreadcrumb\">
			<span id=\"title\">
				<a href=\"all_category_devices.html\">Devices
				</a> > 
			</span>
				".$categoryOfDevice."
			</div>";
		echo $breadcrumb;
		// end

        
		echo "<div class=\"container-fluid text-center\">    
				  <div class=\"row content\">";

				  //barra laterale sinistra
		echo 		"<div class=\"col-sm-2 sidenav\">
       				<br><br>
				    <a href=\"all_category_devices.html\" class=\"btn btn-primary\">Go to Devices</a>
				    </div>";
				   // fine barra laterale

		echo "<div id=\"spazio_centrale\" class=\"col-sm-8 text-left\"> ";
	 
	 	$i=0;
		while($i < sizeof($array) ){
			echo "<div class=\"row content\">";
			// facciamo righe da 3 telefoni 
			for($j = 0; $j < 3 && $i+$j<sizeof($array); $j++){

				echo "<div class=\"col-xs-4\">
						<a href=\"device.html?id=".$array[$i+$j][DEV_ID]."\">
							<img class=\"img-responsive\" src=\"./img/devices/".$array[$i+$j][DEV_MODEL].".jpg\">
							<!-- nome telefono -->
							<center>
							<p>".$array[$i+$j][DEV_NAME]."</p>
							<p>".$array[$i+$j][DEV_PRICE]."€<p>
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


	function getProductsRelated($deviceID, $categoryOfDevice, $limit){

		$array = getProductsRelatedTo($deviceID, $categoryOfDevice, TABLE_PRODUCTS, $limit);

		echo "<div class=\"container-fluid text-center\">    
				  <div class=\"row content\">";

				  //barra laterale sinistra
		echo 		"<div class=\"col-sm-2 sidenav\">
				      <!-- <p><a href=\"#\">Link</a></p> -->
				      <!-- <p><a href=\"#\">Link</a></p> -->
				      <!-- <p><a href=\"#\">Link</a></p> -->
				    </div>";
				   // fine barra laterale

		echo "<div id=\"spazio_centrale\" class=\"col-sm-8 text-left\"> ";
			echo "<div class=\"row content\">";
		
		$colWidth = round(12/$limit, 0, PHP_ROUND_HALF_DOWN);

		for($i =0; $i< sizeof($array); $i++){
				echo "<div class=\"col-xs-".$colWidth."\">
							<a href=\"device.html?tipo=".$categoryOfDevice."&id=".$array[$i][DEV_ID]."\">
								<img class=\"img-responsive\" src=\"./img/devices/".$array[$i][DEV_MODEL].".jpg\">
								<!-- nome telefono -->
								<p>".$array[$i][DEV_NAME]."</p>
								<p>".$array[$i][DEV_PRICE]."€<p>
							</a>
						</div>";
		}
		// chiude row-content
			echo "</div>";
		echo "</div>"; // chiude il div con id spazio_centrale
	    	
	    	//barra laterale destra
		echo "<div class=\"col-sm-2 sidenav\">
			     <!--  <div class=\"well\">
			        <p>ADS</p>
			      </div> -->
			      <!-- <div class=\"well\">
			        <p>ADS</p>
			      </div> -->
			  </div>";
			  // fine barra laterla destra

			  //chiude il container fluid ed il row-content iniziale
		echo "</div>
			</div>";
	}
    
 /*   getAssistance($deviceID){
    		function getAssistanceOfId($assistanceID){
	
		$array = getAssistanceInfoId($assistanceID);
		
		// breadcrumb
		$breadcrumb = "
			<div id=\"mBreadcrumb\">
			<span id=\"title\">
				<a href=\"all_category_assistance.html\">Assistance
				</a> > 
				<a href=\"all_assistances.html?tipo=".$array[AS_CATEGORY]."\">".$array[AS_CATEGORY]."</a> > 
			</span>
				".$array[AS_NAME]."

			</div>";
		echo $breadcrumb;
		// end 




		echo "<div style=\"margin-top:15px\" class=\"container-fluid text-center\">    
				  <div class=\"row content\">";

				  //barra laterale sinistra
		echo 		"<div class=\"col-sm-2 sidenav\">
				      <!-- <p><a href=\"#\">Link</a></p> -->
				      <!-- <p><a href=\"#\">Link</a></p> -->
				      <!-- <p><a href=\"#\">Link</a></p> -->
				    </div>";
				   // fine barra laterale

		echo "<div id=\"spazio_centrale\" class=\"col-sm-8 text-left\">";
			//nuiva riga
			echo "<div class=\"row content\">";

					echo "						
						<h1 id=\"name\">".$array[AS_NAME]."</h1>
						<br>
						<br>
						<h3 id=\"short_desc_title\">DESCRIZIONE</h3>
						<br>
						<h4 id=\"short_desc\">".$array[AS_DESC]."</h4>";
			// chiudi  riga						
			echo "</div>";
			
		echo "</div>"; // chiude il div con #spazio_centrale

			//barra laterale destra
		echo "<div class=\"col-sm-2 sidenav\">
			     <!--  <div class=\"well\">
			        <p>ADS</p>
			      </div> -->
			      <!-- <div class=\"well\">
			        <p>ADS</p>
			      </div> -->
			  </div>";
			  // fine barra laterla destra

			  //chiude il container fluid ed il row-content iniziale
		echo "</div>
			</div>";
	}

*/

	function getSmartLifes($deviceID,$ofType,$deviceName){
    
    	$array = getSmartLifeByDevID($deviceID);
		

		// breadcrumb
		$breadcrumb = "<div id=\"mBreadcrumb\">
			<span id=\"title\">
				<a href=\"all_category_devices.html\">Devices
				</a> > 
				<a href=\"all_devices.html?tipo=".$deviceType."\" >".$deviceType."
				</a> >
                <a href=\"device.html?tipo=".$deviceType."&id=".$deviceID."\">".$deviceName."
				</a> 
			</span>
			>
			<span id=\"item_not_clickable\">SmartLife</span>
			</div>";
		echo $breadcrumb;
		// end
        
		echo "<div class=\"container-fluid text-center\">    
				  <div class=\"row content\">";

				  //barra laterale sinistra
		echo 		"<div class=\"col-sm-3 sidenav\">
        			<br><br>
        			    <a onclick=\"visualizer(".$deviceID.",'visualSmart')\" class=\"btn btn-primary\">Back to ".$deviceName."</a>
                    </div>";
				   // fine barra laterale

		echo "<div id=\"spazio_centrale\" class=\"col-sm-6 \"> <br><br> ";
	 
	 	$i=0;
		while($i < sizeof($array) ){
			echo "<div class=\"row content\">";
                echo "<div class=\"col-xm-6\">
                        <a href=\"".$array[$i][SL_LINK]."?fromDevice=1&deviceId=".$deviceID."&deviceName=".$deviceName."\">
                        <!-- nome assistenza -->
                              <p>".$array[$i][SL_NAME]."</p><br>
                        </a>
                                       
                </div>";
                // chiude row-content
			echo "</div> ";
            $i++;
		}

		echo "</div>"; // chiude il div con id spazio_centrale
	    	
	    	//barra laterale destra
		echo "<div class=\"col-sm-3 sidenav\">
			  </div>";
			  // fine barra laterla destra

			  //chiude il container fluid ed il row-content iniziale
		echo "</div>
			</div>";
    
    }
    


	function getAssistances($deviceID,$deviceType,$deviceName) {

		$array = getAssistancesByDevID($deviceID);
		

		// breadcrumb
		$breadcrumb = "<div id=\"mBreadcrumb\">
			<span id=\"title\">
				<a href=\"all_category_devices.html\">Devices
				</a> > 
				<a href=\"all_devices.html?tipo=".$deviceType."\" >".$deviceType."
				</a> >
                <a href=\"device.html?tipo=".$deviceType."&id=".$deviceID."\">".$deviceName."
				</a> 
			</span>
			>
			<span id=\"item_not_clickable\">Assistances</span>
			</div>";
		echo $breadcrumb;
		// end
        
		echo "<div class=\"container-fluid text-center\">    
				  <div class=\"row content\">";

				  //barra laterale sinistra
		echo 		"<div class=\"col-sm-3 sidenav\">
        			<br><br>
        			    <a onclick=\"visualizer(".$deviceID.",'visualSmart')\" class=\"btn btn-primary\">Back to ".$deviceName."</a>
                    </div>";
				   // fine barra laterale

		echo "<div id=\"spazio_centrale\" class=\"col-sm-6 \"> <br><br> ";
	 
	 	$i=0;
		while($i < sizeof($array) ){
			echo "<div class=\"row content\">";
                echo "<div class=\"col-xm-6\">
                	
                        <a href=\"assistance.html?id=".$array[$i][AS_ID]."&fromDevice=1&deviceId=".$deviceID."&deviceName=".$deviceName."\">
                        <!-- nome assistenza -->
                              <p>".$array[$i+$j][AS_NAME]."</p><br>
                        </a>
                                       
                </div>";
                // chiude row-content
			echo "</div> ";
            $i++;
		}

		echo "</div>"; // chiude il div con id spazio_centrale
	    	
	    	//barra laterale destra
		echo "<div class=\"col-sm-3 sidenav\">
			  </div>";
			  // fine barra laterla destra

			  //chiude il container fluid ed il row-content iniziale
		echo "</div>
			</div>";
	}
?>

</body>
</html>