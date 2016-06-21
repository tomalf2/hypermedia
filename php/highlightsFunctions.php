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
	include'assistanceFunctions.php';


	getHighlightsAssistances();


	function getHighlightsAssistances() {

		$array = getHighlightsServices();
		
        
		echo "<div class=\"container-fluid text-center\">    
				  <div class=\"row content\">";

				  //barra laterale sinistra
		echo 		"<div class=\"col-sm-3 sidenav\">
				      <!-- <p><a href=\"#\">Link</a></p> -->
				      <!-- <p><a href=\"#\">Link</a></p> -->
				      <!-- <p><a href=\"#\">Link</a></p> -->
				    </div>";
				   // fine barra laterale

		echo "<div id=\"spazio_centrale\" class=\"col-sm-6 \"> <br><br> ";
	 
	 	$i=0;
		while($i < sizeof($array) ){
			echo "<div class=\"row content\">";
               
                	
                echo   "<a href=\"assistance.html?tipo=".$categoryOfAssistance."&id=".$array[$i][AS_ID]."&fromHighlights=1\">
                        <!-- nome assistenza -->
                              <p>".$array[$i+$j][AS_NAME]."</p><br>
                        </a>";
                                      
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