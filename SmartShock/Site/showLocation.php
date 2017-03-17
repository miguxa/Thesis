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
	<?php 
		$latitude = $_GET['latitude'];
		$longitude = $_GET['longitude'];
		$forca = $_GET['forca'];
	?>
	<img src="SS.png" style="height:20%;">
	<script>
		var locations = [];
		var labels = [];  
	</script>
	<?php
		$i=0; 
		echo '<script>
			locations['.$i.']={lat: '.$latitude.' , lng: '.$longitude.'};
			labels['.$i.']="'.$forca.'";
		</script>';
	?>
	<div id="map"></div>
	<script>
		var lat1 = <?php echo $latitude; ?>;
		var lon1 = <?php echo $longitude; ?>;
		function initMap() {
			var map = new google.maps.Map(document.getElementById('map'), {
		    zoom: 15,
		    center: {lat: lat1, lng: lon1}
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