<!DOCTYPE html>
<html>
	<head>
		<title>Store Page</title>
		<link rel="icon" href="SSS.png" type="image/gif" sizes="16x16">
	</head>
	<body>
		<?php
			if(isset($_POST)){	
				$Forca = $_POST['Forca'];
				$Lat1 = $_POST['Lat1'];
				$Lat2 = $_POST['Lat2'];
				$Lat3 = $_POST['Lat3'];
				$Lon1 = $_POST['Lon1'];
				$Lon2 = $_POST['Lon2'];
				$Lon3 = $_POST['Lon3'];
				$Ano = $_POST['Ano'];
				$Mes = $_POST['Mes'];
				$Dia = $_POST['Dia'];
				$Hora = $_POST['Hora'];
				$Minutos = $_POST['Minutos'];
				
				$Lat = $Lat2 + $Lat3/10000;
				$Lon = $Lon2 + $Lon3/10000;
				
				if ($Lat1 == '-')
					$Lat = $Lat * -1;
				
				if ($Lon1 == '-')
					$Lon = $Lon * -1;
					
				$connect = mysqli_connect('localhost', 'root', '') or die('Não foi possível conectar: ' . mysql_error());
				mysqli_select_db($connect, 'tese') or die('Não foi possível seleccionar o banco da dados');
				
				$date = date("$Ano-$Mes-$Dia $Hora:$Minutos");
				$query = 'INSERT INTO coordenadas (forca, latitude, longitude, data) VALUES (\''.$Forca.'\',\''.$Lat.'\',\''.$Lon.'\',\''.$date.'\')';
				$result = mysqli_query ($connect, $query) or die('A consulta falhou 2!: ' . mysqli_error($connect));
				if($result === TRUE){
					echo"Coordenada registada com sucesso!";
				}
				else
					echo"Ocorreu um erro no registo!";
			}
		?>
	</body>
</html>