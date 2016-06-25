<?php
header('Access-Control-Allow-Origin: *');
mHeaderTemplate($_REQUEST['pagina']);
function mHeaderTemplate($active){
	echo"
		<img id=\"header_img\" class=\"img-responsive\" src=\"./img/header.jpg\">";
		/*
			<div class=\"container-fluid\">
				<h1>I'm DOOM</h1>
				<p>An now all of you poor COD players are fucked.</p> 
			</div>
		*/
		echo"
		<!-- nav bar -->
		<nav id=\"navbar\" class=\"navbar navbar-inverse\" style=\"margin-bottom: 0px\">
			<div class=\"container-fluid\">
				<div class=\"navbar-header\">
					<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#myNavbar\">
						<span class=\"icon-bar\"></span>
						<span class=\"icon-bar\"></span>
						<span class=\"icon-bar\"></span> 
					</button>
					<a class=\"navbar-brand\" href=\"#\"></a>
				</div>
			<div class=\"collapse navbar-collapse\" id=\"myNavbar\">
				<ul class=\"nav navbar-nav navbar-right\">
					";
					if($active=="home")
						echo"<li class=\"active\">";
					else	
						echo"<li>";
					echo"<a href=\"./index.html\">Home</a></li> ";


					if($active=="devices")
						echo"<li class=\"active\">";
					else	
						echo"<li>";
					echo"<a href=\"./all_category_devices.html\">Devices</a></li>";


	// 				 codice per menu espandibile --> sostituire la echo qui sopra col codice sottostante
	// 					echo"<li class=\"dropdown\">
	// 						<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">Brief hystory of DOOM<span class=\"caret\"></span></a>
	// 						<ul class=\"dropdown-menu\">
	// 							<li><a href=\"#\">Page 1-1</a></li>
	// 							<li><a href=\"#\">Page 1-2</a></li>
	// 							<li><a href=\"#\">Page 1-3</a></li> 
	// 						</ul>
	// 					</li>";
					

						
					if($active=="promotions")
						echo"<li class=\"active\">";
					else
						echo"<li>";
					echo"<a href=\"./promotions.html\">Promotions</a></li>";



					if($active=="assistance")
						echo"<li class=\"active\">";
					else	
						echo"<li>";
					echo"<a href=\"./all_category_assistance.html\">Assistance</a></li>"; 


					if($active=="highlights")
						echo"<li class=\"active\">";
					else	
						echo"<li>";
					echo"<a href=\"./highlights.html\">Highlights</a></li>"; 


					if($active=="smartlife")
						echo"<li class=\"active\">";
					else	
						echo"<li>";
					echo"<a href=\"./all_category_smartlife.html\">Smart Life Services</a></li>"; 


					if($active=="aboutus")
						echo"<li class=\"active\">";
					else	
						echo"<li>";
					echo"<a href=\"./aboutus.html\">About Us</a></li> 


				</ul>
			</div>
		</div>
	</nav>";
}



?>