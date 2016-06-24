<?php
		define("HOST", "localhost"); // E' il server a cui ti vuoi connettere.
		define("USER", "hyp65"); // E' l'utente con cui ti collegherai al DB.
		define("PASSWORD", ""); // Password di accesso al DB.
		define("DATABASE", "my_hyp65"); // Nome del database.
		define("TABLE_PRODUCTS", "products");
        define("TABLE_ASSISTANCE", "assistance");
        define("TABLE_SMART", "smartlife");
        define("TABLE_DEVICEASSISTANCE", "producttofromassistance");
        define("TABLE_DEVICESMART", "producttofromservice");
		define("ID", "id");

		
		define('DEV_BRAND', '2');
		define('DEV_NAME', '0');
		define('DEV_MODEL', '1');
		define('DEV_PRICE', '3');
		define('DEV_SHORT_DESC', '4');
		define('DEV_LONG_DESC', '5');
		define('DEV_FEATURES', '6');
		define('DEV_ID', '7');
		define('DEV_TYPE', '8');
		define('DEV_IN_PROM', '9');

		define('SL_NAME', '0');
		define('SL_DESC', '1');
		define('SL_ACTIV_RULES', '2');
		define('SL_FAQ', '3' );
		define('SL_ID', '4');
		define('SL_TYPE', '5');
		define('SL_IN_PROM', '6');
		define('SL_LINK', '7');
		define('SL_PRICE', '8');
		define('SL_FAMILY', '9');
		define('SL_FAMILY_LINK', '10');
        
        define('AS_NAME', '0');
		define('AS_DESC', '1');
		define('AS_ID', '2');
		define('AS_HIGHLIGHTS', '3');
		define('AS_CATEGORY', '4');

		define('DEVTOSL_DEV_ID', '0');
		define('DEVTOSL_SL_ID', '1');


		
		/*if($_GET["function"]=="getdevicebytype"){
			$array = getInfoByTypeAndTable($_GET["tipo"],TABLE_PRODUCTS);
			echo $array;
		}
        
        if($_GET["function"]=="getservicebytype"){
			$array = getInfoByTypeAndTable($_GET["tipo"],TABLE_ASSISTANCE);
			echo $array;
		}*/
        
        /*echo(getInfoByTypeAndTable("smartphone",TABLE_PRODUCTS)[0][0]);*/
        
		function connect(){
			$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

			if ($mysqli->connect_errno > 0 ) { //verify connection 
					echo "Error to connect to DBMS ";//notify error 
					exit(); //do nothing else 
			} //else 
					//echo "Successful connection"; // connection ok
			return $mysqli;
		}

		function getProductInfoId($id){
          $a;//array con dentro i campi da restituire
          $mysqli = connect();
          if(($statement = $mysqli->prepare("SELECT * FROM ".TABLE_PRODUCTS." WHERE id =?"))){
          	echo $mysqli->error;
            $statement->bind_param('i', $id);
            $statement->execute();
            
            $r = $statement->get_result();
			$a = $r->fetch_array(MYSQLI_NUM);
			$brbr=array();
			foreach($a as $v){
				$stringa=str_replace("*",'',(str_replace( "\r\n", '', (nl2br(utf8_encode( $v))))));
                $stringa=str_replace("{",'<h4>',$stringa);
                $brbr[]=str_replace("}",'</h4>',$stringa);
			}
		  }
          $mysqli->close();
          return $brbr;
           /* $statement->bind_result($a[0],$a[1],$a[2],$a[3],$a[4],$a[5],$a[6],$a[7],$a[8]);

            
            $statement->fetch();

		  }
          $mysqli->close();
          return json_encode($a);
          
          $result = $mysqli->query($query);

          if($result->num_rows >0) {
            $myArray = array();
            while($row = $result->fetch_array(MYSQL_ASSOC))
             $myArray[] = $row; 
            echo json_encode($myArray);
          }*/
         
		}
		
        
        function getSmartLinkFromId($smartLifeID){
          $a;//array con dentro i campi da restituire
          $mysqli = connect();
          if(($statement = $mysqli->prepare("SELECT * FROM ".TABLE_SMART." WHERE id =?"))){
          	echo $mysqli->error;
            $statement->bind_param('i', $smartLifeID);
            $statement->execute();
            
            
            $r = $statement->get_result();
			$a = $r->fetch_array(MYSQLI_NUM);
			$brbr=array();
			foreach($a as $v){
				$brbr[]=str_replace("*",'',(str_replace( "\r\n", '', (nl2br(utf8_encode( $v))))));
			}
		  }
          $mysqli->close();
          return $brbr[SL_LINK];
        }
        
        function getSmartInfoId($smartLifeID){
          $a;//array con dentro i campi da restituire
          $mysqli = connect();
          if(($statement = $mysqli->prepare("SELECT * FROM ".TABLE_SMART." WHERE id =?"))){
          	echo $mysqli->error;
            $statement->bind_param('i', $smartLifeID);
            $statement->execute();
            
            $r = $statement->get_result();
			$a = $r->fetch_array(MYSQLI_NUM);
			$brbr=array();
			foreach($a as $v){
				$brbr[]=str_replace("*",'',(str_replace( "\r\n", '', (nl2br(utf8_encode( $v))))));
			}
		  }
          $mysqli->close();
          return $brbr;
        }
        
        function getAssistanceInfoId($id){
          $a;//array con dentro i campi da restituire
          $mysqli = connect();
          if(($statement = $mysqli->prepare("SELECT * FROM ".TABLE_ASSISTANCE." WHERE id =?"))){
          	echo $mysqli->error;
            $statement->bind_param('i', $id);
            $statement->execute();
            
            $r = $statement->get_result();
			$a = $r->fetch_array(MYSQLI_NUM);
			$brbr=array();
			foreach($a as $v){
				$stringa=str_replace("*",'',(str_replace( "\r\n", '', (nl2br(utf8_encode( $v))))));
                $stringa=str_replace("{",'<h4>',$stringa);
                $brbr[]=str_replace("}",'</h4>',$stringa);
			}
		  }
          $mysqli->close();
          return $brbr;
		}
        
		function getInfoByTypeAndTable($Type,$Table){
          $a;//array con dentro i campi da restituire
          $mysqli = connect();
          if(($statement = $mysqli->prepare("SELECT * FROM $Table WHERE tipo =?"))){
          	echo $mysqli->error;
            $statement->bind_param('s', $Type);
            $statement->execute();
			
			$r = $statement->get_result();
			while($a = $r->fetch_array(MYSQLI_NUM)){
				$brbr=array();
				foreach($a as $v){
					$brbr[]=str_replace("*",'',(str_replace( "\r\n", '', (nl2br(utf8_encode( $v))))));
				}
				$a2[] = $brbr;
			}
			
			
		  }
          $mysqli->close();
          return $a2;
		}

		function getProductsRelatedTo($id, $Type,$Table, $limit){
          
          $a;//array con dentro i campi da restituire
          $mysqli = connect();
          if(($statement = $mysqli->prepare("SELECT * FROM $Table WHERE tipo =? AND id!=? LIMIT ?"))){
          	echo $mysqli->error;
            $statement->bind_param('sii', $Type, $id, $limit);
            $statement->execute();
			
			$r = $statement->get_result();
			while($a = $r->fetch_array(MYSQLI_NUM)){
				$brbr=array();
				foreach($a as $v){
					$brbr[]=str_replace("*",'',(str_replace( "\r\n", '', (nl2br(utf8_encode( $v))))));
				}
				$a2[] = $brbr;
			}
			
			
		  }
          $mysqli->close();
          return $a2;
		}


		function getPromotionDevices($type, $orderBy, $limit){
			$mysqli = connect();
            if(!$type)
            	$toPrepare="SELECT * FROM products WHERE promozione=1";
			else
            	$toPrepare="SELECT * FROM products WHERE tipo='".$type."' AND promozione=1";
            if($orderBy)
            	$toPrepare=$toPrepare." ORDER BY ".$orderBy;
            if($limit) 
                $toPrepare=$toPrepare." LIMIT ".$limit ;
			if(($statement = $mysqli->prepare($toPrepare))){
				echo $mysqli->error;

				$statement->execute();
				$queryResult = $statement->get_result();

				while($row = $queryResult->fetch_array(MYSQLI_NUM)){
					$content=array();
					foreach($row as $messyContent){
						$content[]=str_replace("*",'',(str_replace( "\r\n", '', (nl2br(utf8_encode( $messyContent))))));
					}
					$tidyArray[] = $content;
				}		
			  }
	          $mysqli->close();
	          return $tidyArray;	
		}

		function getPromotionServices($limit){
			$mysqli = connect();
            $toPrepare="SELECT * FROM smartlife WHERE promozione=1 ";
            if($limit)
            	$toPrepare=$toPrepare." LIMIT ".$limit;
			if($statement = $mysqli->prepare($toPrepare)){
				echo $mysqli->error;
				$statement->execute();
				$queryResult = $statement->get_result();

				while($row = $queryResult->fetch_array(MYSQLI_NUM)){
					$content=array();
					foreach($row as $messyContent){
						$content[]=str_replace("*",'',(str_replace( "\r\n", '', (nl2br(utf8_encode( $messyContent))))));
					}
					$tidyArray[] = $content;
				}		
			  }
	          $mysqli->close();
	          return $tidyArray;	
		}
        
        
		function getHighlightsServices(){
			$mysqli = connect();
            $toPrepare="SELECT * FROM assistance WHERE highlights=1 ";
			if($statement = $mysqli->prepare($toPrepare)){
				echo $mysqli->error;
				$statement->execute();
				$queryResult = $statement->get_result();

				while($row = $queryResult->fetch_array(MYSQLI_NUM)){
					$content=array();
					foreach($row as $messyContent){
						$content[]=str_replace("*",'',(str_replace( "\r\n", '', (nl2br(utf8_encode( $messyContent))))));
					}
					$tidyArray[] = $content;
				}		
			  }
	          $mysqli->close();
	          return $tidyArray;	
		}
		
       function getAssistancesByDevID($id){
          $a;//array con dentro i campi da restituire
          $mysqli = connect();
          if(($statement = $mysqli->prepare("SELECT * FROM ".TABLE_DEVICEASSISTANCE." WHERE deviceid=?"))){
          	echo $mysqli->error;
            $statement->bind_param('i', $id);
            $statement->execute();
            $r = $statement->get_result();
           	$brbr=array();
            while($a = $r->fetch_array(MYSQLI_NUM))
                $brbr[]=getAssistanceInfoId($a[1]);

		  }
          $mysqli->close();
          return $brbr;
		}
        
        function getProductsByAssistanceID($assistanceID){
        	$a;//array con dentro i campi da restituire
            $mysqli = connect();
            if(($statement = $mysqli->prepare("SELECT * FROM ".TABLE_DEVICEASSISTANCE." WHERE assistanceid=?"))){
              echo $mysqli->error;
              $statement->bind_param('i', $assistanceID);
              $statement->execute();
              $r = $statement->get_result();
              $brbr=array();
              while($a = $r->fetch_array(MYSQLI_NUM))
                  $brbr[]=getProductInfoId($a[0]);
            }
            $mysqli->close();
            return $brbr;
        }
        
        function getProductsBySmartLifeID($smartLifeID){
        	$a;//array con dentro i campi da restituire
            $mysqli = connect();
            if(($statement = $mysqli->prepare("SELECT * FROM ".TABLE_DEVICESMART." WHERE slid=?"))){
              echo $mysqli->error;
              $statement->bind_param('i', $smartLifeID);
              $statement->execute();
              $r = $statement->get_result();
              $brbr=array();
              while($a = $r->fetch_array(MYSQLI_NUM))
                  $brbr[]=getProductInfoId($a[0]);
            }
            $mysqli->close();
            return $brbr;
        }

		function getSmartLifeByDevID($deviceID){
       		$a;//array con dentro i campi da restituire
            $mysqli = connect();
            if(($statement = $mysqli->prepare("SELECT * FROM ".TABLE_DEVICESMART." WHERE deviceid=?"))){
              echo $mysqli->error;
              $statement->bind_param('i', $deviceID);
              $statement->execute();
              $r = $statement->get_result();
              $brbr=array();
              while($a = $r->fetch_array(MYSQLI_NUM))
                  $brbr[]=getSmartInfoId($a[1]);
            }
            $mysqli->close();
            return $brbr;
        }
?>