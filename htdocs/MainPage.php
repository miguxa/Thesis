<!DOCTYPE html>
<html>
	<head>
		<title>Miguel Prego</title>
		<link rel="icon" href="demo_icon.png" type="image/gif" sizes="16x16">
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	</head>
	<body>

		<h1>This is a Heading</h1>
		<p>This is a paragraph.</p>
	
		<div class="container"> 
			<div class="row">
			  <div class="col-md-4 col-md-offset-1">
				 <h3>Log into your account</h3>
				 <form role="form" method="post" action="Third.php?Lon=1" name="lon">
					<ul style="width: 360px; list-style-type:none"> 
					  <li style="width: 340px">
						<div class="form-group has-feedback">
						  <label>Longitude:</label>
						  North <input type="radio" name="Lon1" value="North">
						  South <input type="radio" name="Lon1" value="South">
						  <input class="form-control" type="text" title="Lon2" name="Lon2" value="" placeholder="Longitude2"/>
						</div>
					  </li>
					  <li style="width: 340px">
						<div class="form-group has-feedback"> 
						  <label>Latitude:</label>
						  <input class="form-control" type="text" title="Lat1" name="Lat1" value="" placeholder="Latitude1"/>
						 </div>
					   </li>
						 <input type="submit" class="btn btn-primary" value="Submit">  
					</ul>
				 </form>
			  </div>	
			</div>
		</div>
	
	
	
		<form action="SecondPage.php">
			Coordenadas <br>
			<input type="radio" name="Lat1" value="North">North
			<input type="radio" name="Lat1" value="South">South
			<input type="number" name="Lat2" value="38.6608" placeholder="38" style="width: 80px" step="0.00001" min="0" max="90">
			<br>
			<input type="radio" name="Lon1" value="East">East &nbsp 
			<input type="radio" name="Lon1" value="West">West &nbsp
			<input type="number" name="Lon2" value="-9.2049" placeholder="009" style="width: 80px" step="0.00001" min="-180" max="180">
			<br><br>
			<button type="submit" method="POST">
				Click Here!!
			</button>
		</form>
		
		<!-- <img src="Mapa_FCT.PNG" alt="O Mapa" style="width: 50%; height: 50%"> -->
		
		<br><br><br>
		
		<div style="width:800px;max-width:100%;overflow:hidden;height:800px;">
			<div id="embedded-map-display" style="height:100%; width:100%;max-width:100%;">
				<iframe style="height:100%;width:100%;border:0;" frameborder="0" 
				src="https://www.google.com/maps/embed/v1/place?q=38.6608,-9.2049&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU">
				</iframe>
			</div>
			<a class="embedded-map-code" rel="nofollow" href="http://www.szablonypremium.pl" id="get-data-for-embed-map">szablonypremium.pl</a>
			<style>#embedded-map-display img{max-width:none!important;background:none!important;}</style>
		</div>	
	</body>
</html>

