<?php
//start the session
session_start();
if(!isset($_SESSION["user_logged"])){
	//page that we want to redirect
	echo("<script>location.href = '/signin.php';</script>");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Virtual Enterprises</title>
 	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">

    <script type="text/javascript">
                
    	function checkEmail_user(){
    		var email = document.forms["userEmail"]["email"].value;

    		if (email == null || email == ""){
                    alert("You need to fill the field before submiting");
                    return false;
            }else if(!validateEmail(email)){
                    alert("Please insert a valid email!")
                    return false;
                }	
            return true;
    	}

    	function checkPass_user(){
    		var password = document.forms["userPass"]["password"].value;

    		if (password == null || password == ""){
                alert("You need to fill the field before submiting");
                return false;
            }
            else{
            	return true;
            }
    	}

    	function checkFile(){
    		var cv = document.getElementById("userfile");

    		if(cv.value == ""){
                    alert("You need to select a file");
                    return false;
            }else{
            	return true;
            }
    	}

    	function checkEmail_company(){
    		var email = document.forms["companyEmail"]["email"].value;

    		if (email == null || email == ""){
                    alert("You need to fill the field before submiting");
                    return false;
            }else if(!validateEmail(email)){
                    alert("Please insert a valid email!")
                    return false;
                }	
            return true;
    	}

    	function checkPass_company(){
    		var password = document.forms["companyPass"]["password"].value;
    		if (password == null || password == ""){
                    alert("You need to fill the field before submiting");
                    return false;
            }
            else{
            	return true;
            }
    	}

    	function validateEmail(email){
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            return re.test(email);
        }

    </script>
</head>
<body>

<!-- Nav Bar-->
		<nav class="navbar navbar-default" style="background-color:black">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a href="#">
		      	<img alt="Brand" src="img/brand.png">
		      </a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		      </ul>
				<ul class="nav navbar-nav navbar-left">
					<li>
						<a class="btn btn-success" href="home.php" style="color: white">Go back!</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="#" style="color: white">
							<?php
								if(isset($_SESSION["user_logged"])){
									echo $_SESSION["user_mail"];
								}
							?>
						</a>
					</li>
					<li>
						<a href="logout.php" style="color:white"> Logout</a>
					</li>
				</ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>		
		
<!-- php para ver qual iremos mostrar -->
<?php	
	$user_id = $_SESSION["user_id"];
	$user_role = $_SESSION["user_role"];
	//user_role = 0 ---> é um trabalhador
	//user_role = 1 ---> é uma empresa
		if($user_role == 0){
			?>
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<form role="form" method="post" action="editprofile.php?changeEmail=1" onsubmit="return checkEmail_user()" id="userEmail">
				     		<div class="form-group has-feedback">
				       	 		<label>Email:</label>
				          		<input class="form-control" type="text" title="email" name="email" value="" placeholder="Change your email"/>
				          		<i class="glyphicon glyphicon-user form-control-feedback"></i>
					    	</div>
					    	<input type="submit" class="btn btn-primary" value="Submit">  
				     	</form>
				     	<form role="form" method="post" action="editprofile.php?changePassword=1" style="margin-top:25px" onsubmit="return checkPass_user()" id="userPass">
				     		<div class="form-group has-feedback">
				       	 		<label>Password:</label>
				          		<input class="form-control" type="password" title="Password" name="password" value="" placeholder="Change your password"/>
				          		<i class="glyphicon glyphicon-lock form-control-feedback"></i>
					    	</div>
					    	<input type="submit" class="btn btn-primary" value="Submit">  
				     	</form>
				     	<form role="form" method="post" action="editprofile.php?changeCv=1" style="margin-top:25px" onsubmit="return checkFile()" enctype="multipart/form-data">
				     		<div class="form-group">
				     			<label>Change your CV:</label>
                           		<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                            	<input name="userfile" type="file" id="userfile"> 
                            	<input type="submit" class="btn btn-primary" value="Submit" style="margin-top:10px"> 
				     		</div>
				     	</form>
			     	</div>
				</div>
			</div>
			<?php

		}else if($user_role == 1){
			?>
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<form role="form" method="post" action="editprofile.php?changeEmail=1" onsubmit="return checkEmail_company()" id="companyEmail">
				     		<div class="form-group has-feedback">
				       	 		<label>Email:</label>
				          		<input class="form-control" type="text" title="email" name="email" value="" placeholder="Change your email"/>
				          		<i class="glyphicon glyphicon-user form-control-feedback"></i>
					    	</div>
					    	<input type="submit" class="btn btn-primary" value="Submit">  
				     	</form>
				     	<form role="form" method="post" action="editprofile.php?changePassword=1" style="margin-top:25px; margin-bottom:25px" onsubmit="return checkPass_company()" id="companyPass">
				     		<div class="form-group has-feedback">
				       	 		<label>Password:</label>
				          		<input class="form-control" type="password" title="Password" name="password" value="" placeholder="Change your password"/>
				          		<i class="glyphicon glyphicon-lock form-control-feedback"></i>
					    	</div>
					    	<input type="submit" class="btn btn-primary" value="Submit">  
				     	</form>
			     	</div>
				</div>
			</div>

			<?php
		}

?>

<?php

if(isset($_GET["changeEmail"])){ 
	$method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
    	$servername = "localhost";
        $db_username = "root";
        $db_password = "ev2015";
        $db_name = 'mydb';

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $db_name);

        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        else{
        	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING); 
        	$user_id = $_SESSION["user_id"];

        	$sql_query ="UPDATE users SET email='$email' WHERE id_user='$user_id'";
        	
        	$result = $conn->query($sql_query); 
        	if($result){
        		$_SESSION["user_mail"]=$email;
        		?>
        		<div class="container">
                    <div class="row">
                      <div class="col-md-4 col-md-offset-4">
                        <div class="alert alert-success alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Well Done!</strong> Update done with success!
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
        	}else{
        		?>
        		<div class="container">
                    <div class="row">
                      <div class="col-md-4 col-md-offset-4">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>ERROR!</strong> E-mail already in use!
                        </div>
                      </div>
                    </div>
                  </div>
                 <?php
        	}
        }
    }
}

if(isset($_GET["changePassword"])){ 
	$method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
    	$servername = "localhost";
        $db_username = "root";
        $db_password = "ev2015";
        $db_name = 'mydb';

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $db_name);

        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        else{
        	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        	$user_id = $_SESSION["user_id"];

        	$sql_query ="UPDATE users SET password='$password' WHERE id_user='$user_id'";
        	
        	$result = $conn->query($sql_query);

        	if($result){
        		?>
        		<div class="container">
                    <div class="row">
                      <div class="col-md-4 col-md-offset-4">
                        <div class="alert alert-success alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Well Done!</strong> Update done with success!
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
        	}else{

        	}
        }
    }
}

if(isset($_GET["changeCv"])){ 
	$method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
    	$servername = "localhost";
        $db_username = "root";
        $db_password = "ev2015";
        $db_name = 'mydb';

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $db_name);

        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        else{
    		$user_id = $_SESSION["user_id"];
            //codigo para eliminar o CV antigo
            $sql_query ="SELECT name FROM users WHERE id_user='$user_id'";
            $result = $conn->query($sql_query);
            if($result){
                $profile = mysqli_fetch_array($result);
                $email = $_SESSION["user_mail"];
                $file = $profile['name'];
                $target_dir = "C:\\ev\\xampp\\htdocs\\ev\\cvs\\";
                $target_file = $target_dir . basename($email."-".$file);
                if(unlink($target_file)){
                    //sucesso ao eliminar
                }else{
                    //erro
                }

            }else{
                //deu erro
            }

            //codigo para guardar o novo CV
    		$fileName = $_FILES['userfile']['name'];
            $tmpName  = $_FILES['userfile']['tmp_name'];
            $fileSize = $_FILES['userfile']['size'];
            $fileType = $_FILES['userfile']['type'];

            $fp      = fopen($tmpName, 'r');
            $content = fread($fp, filesize($tmpName));
            $content = addslashes($content);
            fclose($fp);

            if(!get_magic_quotes_gpc())
            {
                $fileName = addslashes($fileName);
            }

            $sql_query ="UPDATE users SET cv='$content', size='$fileSize', type='$fileType', name='$fileName' WHERE id_user='$user_id'";
            
            $result = $conn->query($sql_query);
            if($result){
                include('upload_evr.php'); //guardar na pasta cvs o novo CV;
                ?>
        		<div class="container">
                    <div class="row">
                      <div class="col-md-4 col-md-offset-4">
                        <div class="alert alert-success alert-dismissible" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Well Done!</strong> Update done with success!
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
        	}else{

        	}
        }
    }
}
?>


<!--FOOTER -->
<footer class="footer">
	<div class="container">
		<div class="row">
			<div style="text-align: center">
				<p class="text-muted"> Empresas Virtuais - Equipa X @ 2014/2015</p>
			</div>
		</div>
	</div>
</footer>


</body>
</html>