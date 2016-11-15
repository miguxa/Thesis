<!DOCTYPE html>
<html>
	<head>
		<title>Page Title</title>
	</head>
	<body>

	<h1>Olha, um titulo!!</h1>
	<p>E um paragrafo!!</p>
<?php echo $_GET['Lat2'] . ' ' . $_GET['Lon2']; ?>
	<div style="width:800px;max-width:100%;overflow:hidden;height:800px;">
			<div id="embedded-map-display" style="height:100%; width:100%;max-width:100%;">
				<iframe style="height:100%;width:100%;border:0;" frameborder="0" 
				src="https://www.google.com/maps/embed/v1/place?q=<?php echo $_GET['Lat2']; ?>,<?php echo $_GET['Lon2']; ?>&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU">
				</iframe>
			</div>
			<a class="embedded-map-code" rel="nofollow" href="http://www.szablonypremium.pl" id="get-data-for-embed-map">szablonypremium.pl</a>
			<style>#embedded-map-display img{max-width:none!important;background:none!important;}</style>
		</div>	
	</body>
</html>