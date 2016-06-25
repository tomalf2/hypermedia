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
	$assistanceID = $_GET['id'];
    $fromDevice = $_GET['fromDevice'];
    $deviceID = $_GET['deviceID'];
    $deviceName = $_GET['deviceName'];
    $fromHighlights = $_GET['fromHighlights'];
    $assistanceName = $_GET['name'];
    
	
	switch ($what) {
		case 'assistance':
			getAssistanceOfId($assistanceID,$fromHighlights,$fromDevice,$deviceID,$deviceName);
			break;
		case 'list':
			getAssistances($ofType);
			break;	
        case 'relatedProducts':
        	getProducts($assistanceID,$ofType,$assistanceName);
            break;
        case '':
        	break;
		default:
			echo "javascript did not called the right function, check you have set the right what parameter";
			break;
	}



	//declared_functions
	function getAssistanceOfId($assistanceID,$fromHighlights,$fromDevice,$deviceID,$deviceName){
    
		$array = getAssistanceInfoId($assistanceID);
        
        
        $numberOfRelatedProducts = sizeof(getProductsByAssistanceID($assistanceID));
		
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
        			<br>";
                    echo"<a href=\"all_assistances.html?tipo=".$array[AS_CATEGORY]."\" class=\"btn btn-primary\">Go to ".$array[AS_CATEGORY]."</a><br><br>";
        			if($fromHighlights==1)
				      	echo"<a href=\"highlights.html\" class=\"btn btn-primary\">Back to Highlights</a>";
                    else{
				    	if($fromDevice==1){ 
                        	echo"<a href=\device.html?id=".$deviceID." class=\"btn btn-primary\">Back to ";
                             if(strlen(urldecode($deviceName))> 14)
                                	echo ''.substr(urldecode($deviceName),0,14)."...</a>";
                                else
                                	echo ''.urldecode($deviceName)."</a>";
                            }
                    }
                    
                    	echo"<br><br><a onclick=\"getRelatedProducts(".$array[AS_ID].",'".$array[AS_NAME]."','".$array[AS_CATEGORY]."','visualSmart')\" class=\"btn btn-primary";
                        if( $numberOfRelatedProducts < 1)
                        	echo " disabled";
                        echo "\">Correlated Products</a>";
                    echo"</div>";
                    
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



	function getAssistances($categoryOfAssistance) {

		$array = getInfoByTypeAndTable($categoryOfAssistance,TABLE_ASSISTANCE);

		// breadcrumb
		$breadcrumb = "
			<div id=\"mBreadcrumb\">
			<span id=\"title\">
				<a href=\"all_category_assistance.html\">Assistance
				</a> > 
			</span>
				".$categoryOfAssistance."
			</div>";
		echo $breadcrumb;
		// end 
        
		echo "<div class=\"container-fluid text-center\">    
				  <div class=\"row content\">";

				  //barra laterale sinistra
		echo 		"<div class=\"col-sm-3 sidenav\">
        			<br>
				     <a href=\"all_category_assistance.html\" class=\"btn btn-primary\">Go to Assistance</a>
				    </div>";
				   // fine barra laterale

		echo "<div id=\"spazio_centrale\" class=\"col-sm-6 \"> ";
	 
	 	$i=0;
		while($i < sizeof($array) ){
			echo "<div class=\"row content\">";
                echo "<div class=\"col-xm-6\">
                	
                        <a href=\"assistance.html?tipo=".$categoryOfAssistance."&id=".$array[$i][AS_ID]."\">
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
    
    function getProducts($assistanceID,$ofType,$assistanceName){
    
		$array = getProductsByAssistanceID($assistanceID);

		// breadcrumb
		$breadcrumb = "
			<div id=\"mBreadcrumb\">
			<span id=\"title\">
				<a href=\"all_category_assistance.html\">Assistance
				</a> > 
				<a href=\"all_assistances.html?tipo=".$ofType."\">".$ofType."</a> > 
                <a href=\"all_assistances.html?tipo=".$ofType."&id=".$assistanceID."\">".$assistanceName."</a> > 
			</span>
				Devices

			</div>";
		echo $breadcrumb;
		// end 
        
		echo "<div class=\"container-fluid text-center\">    
				  <div class=\"row content\">";

				  //barra laterale sinistra
		echo 		"<div class=\"col-sm-3 sidenav\">
        			<br><br>
						<a onclick=\"visualizer(".$assistanceID.",'visualSmart')\" class=\"btn btn-primary\">Back to ";
                        if(strlen(urldecode($assistanceName))> 14)
                                	echo ''.substr(urldecode($assistanceName),0,14)."...</a>";
                                else
                                	echo ''.urldecode($assistanceName)."</a>";
                   echo "</div>";
				   // fine barra laterale

		echo "<div id=\"spazio_centrale\" class=\"col-sm-6 \"> <br><br> ";
	 
	 	$i=0;
		for($i=0;$i < sizeof($array);$i+=4 ){
			echo "<div class=\"row content\">";
            	for($j=0; $j<4 && $i+$j < sizeof($array);$j++){
                echo "<div class=\"col-xs-3\">
                		
                        <a href=\"device.html?id=".$array[$i+$j][DEV_ID]."&fromAssistance=1&assistanceId=".$assistanceID."&assistanceName=".$assistanceName."\">
                        <!-- immagine device -->
                        <img  class=\"img-responsive\" src=\"/img/devices/".$array[$i+$j][DEV_MODEL].".jpg\">
                        <!-- nome device -->
                              <p>".$array[$i+$j][DEV_NAME]."</p><br>
                        </a>
                                       
                </div>";
                }
                // chiude row-content
			echo "</div> ";
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