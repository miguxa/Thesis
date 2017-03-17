<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<link rel="icon" href="SSS.png" type="image/gif" sizes="16x16">
	<title>Mapa Total</title>
	<style>
		#map {height: 90%;}
		html, body {height: 90%; margin: 1%; padding: 0;}
	</style>
</head>
<body>
	<img src="SS.png" style="height:20%;">
	<script>
		var locations = [];
		var labels = [];	
	</script>
	<?php
		$connect = mysqli_connect('localhost', 'root', '') or die('Não foi possível conectar: ' . mysql_error());
		mysqli_select_db($connect, 'tese') or die('Não foi possível seleccionar o banco da dados');
		$query = 'SELECT FORCA, LATITUDE, LONGITUDE FROM COORDENADAS';
		$result = mysqli_query ($connect, $query);
		$number = mysqli_num_rows($result);
		$i=0;
		if(mysqli_num_rows($result)>0)        
		while($rows = mysqli_fetch_array($result)){
			echo '<script>
				locations['.$i.']={lat:'.$rows["LATITUDE"].' , lng: '.$rows["LONGITUDE"].'};
				labels['.$i.']="'.$rows["FORCA"].'";
			</script>';
			$i = $i + 1;
		}
	?>
	<div id="map"></div>
	<script>
		function initMap() {
			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 10,
				center: {lat: 38.6598, lng: -9.2037}
			});
	        var markers = locations.map(function(location, i) {
	        	return new google.maps.Marker({
	        		position: location,
	        		label: labels[i]
	        	});
	        });
	        var markerCluster = new MarkerClusterer(map, markers,
	        	{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
	    }
	</script>
	<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
	</script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWSJAYNSvMH3f_65A-xMS2gbGipI90Ehg&callback=initMap">
	</script>
</body>
</html>