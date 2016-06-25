<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	header('Access-Control-Allow-Origin: *');
	include'database.php';



	$what = $_GET['what'];

	$ofType = $_GET['tipo'];
	$limit = $_GET['limit'];
    $all = $_GET['all'];
    
	switch ($what) {
		case 'devices_not_sl':
			getDevicesInPromotionForHome($ofType, $limit);
            break;
        case 'devices':
            getDevicesInPromotionOptionalByType($ofType,"costo");
			break;
		case 'services_and_sl_devices':
			getSLInPromotionForHome($limit);
			break;
        case 'services':
			getSLInPromotion();
			break;
		default:
			echo "wrong value of attribute what in GET";
			break;
	}


	function getDevicesInPromotionForHome($ofType, $limit){
		
		$devices = getPromotionDevices($ofType, 'costo', $limit);

		echo "<div class=\"container-fluid text-center\">
				<div class=\"row content\">";

		$colWidth = round(12/$limit, 0, PHP_ROUND_HALF_DOWN);

		for($i=0; $i<sizeof($devices); $i++){
			echo "<div class=\"col-xs-".$colWidth."\">
				<a href=\"device.html?tipo=".$ofType."&id=".$devices[$i][DEV_ID]."&fromHome=1\">
					<img class=\"img-responsive\" src=\"./img/devices/".$devices[$i][DEV_MODEL].".jpg\">
								<!-- nome telefono -->
								<p>".$devices[$i][DEV_NAME]."</p>
								<p>".$devices[$i][DEV_PRICE]."€<p>
							</a>
						</div>";
		}
		echo 	"</div>
				</div>";

	}


	function getSLInPromotionForHome($limit){
/*
		$limit_devices = getRealRand(0, $limit);//found a random number of devices in promotions to fetch from database
		$devices = getPromotionDevices('smartLiving', "costo", $limit_devices);

		//maybe that the resuting query hasn't so much devices in 
		//promotion so query as much services as $limit - sizeof($devices
		//if we're lucky that'll be equal to $limit - $limit_devices 
		$services = getPromotionServices($limit - sizeof($devices) );
		$limit_services = sizeof($services);*/

		$limit_devices = 1;
		$limit_services = 1;
		for($copy_limit = $limit -2; $copy_limit>0; $copy_limit--){
			if( getInt01Rand() == 1)
				$limit_devices++;
			else
				$limit_services++;
		}
		$devices = getPromotionDevices('smartLiving', 'costo', $limit_devices);
		$services = getPromotionServices( $limit_services );

		echo "<div class=\"container-fluid text-center\">
				<div class=\"row content\">";

		$colWidth = round(12/$limit, 0, PHP_ROUND_HALF_DOWN);

		for($i=0; $i<$limit_services; $i++){
			echo "<div class=\"col-xs-".$colWidth."\">
					<a href=\"".$services[$i][SL_LINK]."&fromHome=1\">
						<img class=\"img-responsive\" src=\"./img/smartliving/".$services[$i][SL_ID].".jpg\">
							<p>".$services[$i][SL_NAME]."</p>
							<p>".$services[$i][SL_PRICE]."</p>
					</a>
				</div>";
		}
		for($i=0; $i<$limit_devices; $i++){
			echo "<div class=\"col-xs-".$colWidth."\">
					<a href=\"device.html?tipo=".$ofType."&id=".$devices[$i][DEV_ID]."&fromHome=1\">
						<img class=\"img-responsive\" src=\"./img/devices/".$devices[$i][DEV_MODEL].".jpg\">
							<p>".$devices[$i][DEV_NAME]."</p>
							<p>".$devices[$i][DEV_PRICE]."€<p>
					</a>
				</div>";
		}
		
		echo 	"</div>
				</div>";
	}



	function getDevicesInPromotionOptionalByType($ofType,$order){
        if($ofType!=''){
			$devices = getPromotionDevices($ofType, $order,null);
            switch($ofType){
              case smartphone: $orderBy='Smartphones'; break;
              case tablet: $orderBy='Tablets'; break;
              case modem: $orderBy='Networking'; break;
              case smartLiving: $orderBy='SmartDevices'; break;
            }
        }
		else{
        	$devices = getPromotionDevices(null,$order,null);
			$orderBy='Price';
		}
        
		echo "<div class=\"container-fluid text-center\">";
		
			echo "<div style=\"margin-top:15px\" class=\"container-fluid text-center\">    
					  <div class=\"row content\">
					  <!--barra laterale sinistra-->
						<div class=\"col-sm-3 sidenav\">
                          <div class=\"btn-group\">
                              <button id=\"filter\" type=\"button\" class=\"btn btn-primary\">OrderBy : ".$orderBy."</button>
                              <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\">
                               	  <span class=\"caret\"></span>
                              </button>
                              <ul class=\"dropdown-menu\" role=\"menu\">
                               	  <li><a onclick=\"getPromotionDevicesOrderBy('visualSmart','costo')\">Price</a></li>
                              	  <li><a onclick=\"getPromotionDevicesOrderBy('visualSmart','smartphone')\">Smartphone</a></li>
                                  <li><a onclick=\"getPromotionDevicesOrderBy('visualSmart','tablet')\">Tablets</a></li>
                                  <li><a onclick=\"getPromotionDevicesOrderBy('visualSmart','modem')\">Networking</a></li>
                                  <li><a onclick=\"getPromotionDevicesOrderBy('visualSmart','smartLiving')\">SmartDevices</a></li>
                              </ul>
                          </div>
						</div>
					  <!--fine barra laterale-->

				<div id=\"spazio_centrale\" class=\"col-sm-7 text-left\">";
						
				//nuova riga
				for($i=0; $i<sizeof($devices); $i+=3){
					echo"<div class=\"row content\">";

					for($j=0; $j<3 && $j+$i < sizeof($devices); $j++){
						echo"<div class=\"col-xs-4\">
							<a href=\"device.html?tipo=".$ofType."&id=".$devices[$i+$j][DEV_ID]."&fromPromotion=1&order=".$orderBy."\">
								<img class=\"img-responsive\" src=\"./img/devices/".$devices[$i+$j][DEV_MODEL].".jpg\">
											<!-- nome telefono -->
											<p>".$devices[$i+$j][DEV_NAME]."</p>
											<p>".$devices[$i+$j][DEV_PRICE]."€<p>
										</a>
							</div>";
					}
					echo"</div>";
				}
		   
				   echo "</div>"; // chiude il div con #spazio_centrale

				//barra laterale destra
			echo "<!--barra laterale destra-->
					<div class=\"col-sm-2 sidenav\">
				    </div>
				  <!-- fine barra laterla destra-->

				  <!--chiude il container fluid ed il row-content iniziale-->
				</div>
			</div>";

	}

      function getSLInPromotion(){
      
		$services = getPromotionServices(null);

		echo "<div class=\"container-fluid text-center\">";
		
			echo "<div style=\"margin-top:15px\" class=\"container-fluid text-center\">    
					  <div class=\"row content\">
					  <!--barra laterale sinistra-->
						<div class=\"col-sm-2 sidenav\">
						  <!-- <p><a href=\"#\">Link</a></p> -->
						  <!-- <p><a href=\"#\">Link</a></p> -->
						  <!-- <p><a href=\"#\">Link</a></p> -->
						</div>
					  <!--fine barra laterale-->

						<div id=\"spazio_centrale\" class=\"col-sm-8 text-left\">";
						
				//nuova riga
		
		echo "<div class=\"container-fluid text-center\">";
        
		 for($i=0; $i<sizeof($services); $i+=3){
        	echo"<div class=\"row content\">";

			  for($j=0; $j<3 && $j < sizeof($services); $j++){
				  echo "<div class=\"col-xs-4\">
						  <a href=\"".$services[$i+$j][SL_LINK]."\">
							  <img class=\"img-responsive\" src=\"./img/smartliving/".$services[$i+$j][SL_ID].".jpg\">
								  <p>".$services[$i+$j][SL_NAME]."</p>
								  <p>".$services[$i+$j][SL_PRICE]."</p>
						  </a>
					  </div>";
			  }
		}
		
		 echo "</div>"; // chiude il div con #spazio_centrale

				//barra laterale destra
			echo "<!--barra laterale destra-->
					<div class=\"col-sm-2 sidenav\">
				    </div>
				  <!-- fine barra laterla destra-->

				  <!--chiude il container fluid ed il row-content iniziale-->
				</div>
			</div>";
	}


	function getRealRand($min, $max){

		$max=$max*100;
		$rand_val = mt_rand($min, $max);
		return floor($rand_val/100);
	}

	function getInt01Rand(){
		$float = (float) mt_rand() / (float) mt_getrandmax();
		return round($float, 0, PHP_ROUND_HALF_UP);
	}

?>

</body>
</html>