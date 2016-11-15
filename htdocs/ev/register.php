<!DOCTYPE html>
<html>
    <head>
        <title>Virtual Enterprises</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <!-- Datetime picker-->
        <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/d004434a5ff76e7b97c8b07c01f34ca69e635d97/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
        <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/d004434a5ff76e7b97c8b07c01f34ca69e635d97/src/js/bootstrap-datetimepicker.js"></script>
        <!-- Custom styles for this template -->
        <link href="sticky-footer.css" rel="stylesheet">
        <script src="tag_it/js/tag-it.js"></script>
        <link rel="stylesheet" href="tag_it/css/jquery.tagit.css" />

        <link rel="stylesheet" href="tag_it/css/tagit.ui-zendesk.css" />
        <script>
            $(document).ready(function () {
                


                $('#SkillsTags').tagit({
                    allowSpaces: true
                });

                $("#SkillsTags").keyup(function () {
                    $("#skillsSet").val($("#SkillsTags").tagit("assignedTags"));

                });



                $("#optionUser").click(function () {
                    $("#registerOptions").hide(1000);
                    $("#registerUser").show(1500);
                });
                $("#optionCompany").click(function () {
                    $("#registerOptions").hide(1000);
                    $("#registerCompany").show(1500);
                });
                $("#nextUser").click(function () {
                    $("#generalUser").hide(1000);
                    $("#restUser").show(1500);
                });
                $("#prevUser").click(function () {
                    $("#restUser").hide(1000);
                    $("#generalUser").show(1500);
                });
                $("#nextCompany").click(function () {
                    $("#generalCompany").hide(1000);
                    $("#restCompany").show(1500);
                });
                $("#prevCompany").click(function () {
                    $("#restCompany").hide(1000);
                    $("#generalCompany").show(1500);
                });
            });

        </script>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker').datetimepicker({
                    viewMode: 'years',
                    format: 'YYYY-MM-DD'
                });
            });
        </script>

        <script type="text/javascript">

            //var confirmPassword = document.forms["registerCompany"]["confirmPassword-company"].value;
            function validateFormUser() {
                var firstName = document.forms["formUser"]["firstName"].value;
                var lastName = document.forms["formUser"]["lastName"].value;
                var email = document.forms["formUser"]["email"].value;
                var password = document.forms["formUser"]["password"].value;
                var confirmPassword = document.forms["formUser"]["confirmPassword"].value;
                var professionalGroup = document.forms["formUser"]["professionalGroup"].value;
                var country = document.forms["formUser"]["country"].value;
                //var skills = document.forms["formUser"]["setSkills"].value;
                var date = document.forms["formUser"]["birthDate"].value;
                var cv = document.getElementById("userfile");


                if (firstName == null || firstName == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (lastName == null || lastName == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (email == null || email == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (password == null || password == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (confirmPassword == null || confirmPassword == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (professionalGroup == null || professionalGroup == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (country == null || country == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                /*if(skills == null || skills ==""){
                 alert("You need to fill all fields");
                 return false;
                 }*/
                if (date == null || date == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (cv.value == "") {
                    alert("You need to select a file");
                    return false;
                }
                if (!(password == confirmPassword)) {
                    alert("Passwords don't match!");
                    return false;
                }
                if (!validateEmail(email)) {
                    alert("Please insert a valid email!")
                    return false;
                }
                return true;
            }

            function validateFormCompany() {
                var firstName = document.forms["formCompany"]["firstName"].value;
                var lastName = document.forms["formCompany"]["lastName"].value;
                var email = document.forms["formCompany"]["email"].value;
                var password = document.forms["formCompany"]["password"].value;
                var confirmPassword = document.forms["formCompany"]["confirmPassword"].value;
                var professionalGroup = document.forms["formCompany"]["professionalGroup"].value;
                var comName = document.forms["formCompany"]["companyName"].value;
                var country = document.forms["formCompany"]["country"].value;

                if (firstName == null || firstName == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (lastName == null || lastName == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (email == null || email == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (password == null || password == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (confirmPassword == null || confirmPassword == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (professionalGroup == null || professionalGroup == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (comName == null || comName == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (country == null || country == "") {
                    alert("You need to fill all the fields");
                    return false;
                }
                if (!(password == confirmPassword)) {
                    alert("Passwords don't match!");
                    return false;
                }
                if (!validateEmail(email)) {
                    alert("Please insert a valid email!")
                    return false;
                }
                return true;
            }

            function validateEmail(email) {
                var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
                return re.test(email);
            }

        </script>

        <script type="text/javascript">
            $(function () {
                $('#datetimepicker').datetimepicker();
            });
        </script>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <a href="signin.php">
                        <img src="img/header.png">
                    </a>
                </div>
            </div>
            <hr>
            <h2 style="color: #5bc0de">
                Setup your account for free!
            </h2>  
        </div>    

        <div class="container" id="registerOptions" style="margin-top:40px"> 
            <div class="row">
                <div class="col-md-3 col-md-offset-3" id="optionUser">
                    <button class="btn btn-primary" style="width:200px">I'm looking for work!</button>
                    <p style="display:block; width: 200px; margin-top:25px">      		
                        You are a contractor looking for freelance work. 
                        You will be able to manage you CV/Resume and apply to thousands of jobs.
                    </p>
                </div>
                <div class="col-md-4" id="optionCompany">
                    <button class="btn btn-primary" style="width:200px">I want to hire!</button>
                    <p style="display:block; width: 200px; margin-top:25px">      		
                        You are an employer looking to post a 
                        job and manage applications, or simply search for 
                        freelancers from our database.
                    </p>
                </div>
            </div>	
        </div>

        <!-- We need different forms because they have different fields like CV-->
        <!-- Form for the user-->
        <div class="container" id="registerUser" style="display: none">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form role="form" method="post" action="register.php?register=0" onsubmit="return validateFormUser()" id="formUser" enctype="multipart/form-data">
                        <div class="form-group" id="generalUser">
                            <label>First Name:</label>
                            <input class="form-control" type="text" name="firstName" value="" placeholder="">
                            <label>Last Name:</label>
                            <input class="form-control" type="text" name="lastName" value="" placeholder="">
                            <label>E-mail:</label>
                            <input class="form-control" type="text" name="email" value="" placeholder="">
                            <label>Password:</label>
                            <input class="form-control" type="password" name="password" value="" placeholder="">
                            <label>Confirm the password:</label>
                            <input class="form-control" type="password" name="confirmPassword" value="" placeholder="">
                            <button type="button" class="btn btn-success" id="nextUser" style="margin-top:25px">Next Step</button>
                        </div>
                        <div class="form-group" style="display: none" id="restUser">
                            <label>Your professional group:</label>
                            <input class="form-control" type="text" name="professionalGroup" value="" placeholder="">
                            <label>Please state your skills (skill1; skill2):</label>
                            <ul id="SkillsTags"></ul>
                            <input id="skillsSet" class="form-control" type="text" name="setSkills" value="" placeholder="" style="display:none;">
                            <label>Your birth date:</label>
                            <div class='input-group date' id='datetimepicker'>
                                <input type='text' class="form-control" name ="birthDate" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <label>Country:</label>
                            <input class="form-control" type="text" name="country" value="" placeholder="">
                            <label>Send us your CV:</label>
                            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                            <input name="userfile" type="file" id="userfile"> 
                            <button type="button" class="btn btn-success" id="prevUser" style="margin-top:25px">Go back!</button>
                            <input type="submit" class="btn btn-success" value="Submit" style="margin-top:25px">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Form for the service provider-->
        <div class="container" id="registerCompany" style="display: none">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form role="form" method="post" action="register.php?register=1" onsubmit="return validateFormCompany()" id="formCompany">
                        <div class="form-group" id="generalCompany">
                            <label>First Name:</label>
                            <input class="form-control" type="text" name="firstName" value="" placeholder="">
                            <label>Last Name:</label>
                            <input class="form-control" type="text" name="lastName" value="" placeholder="">
                            <label>E-mail:</label>
                            <input class="form-control" type="text" name="email" value="" placeholder="">
                            <label>Password:</label>
                            <input class="form-control" type="password" name="password" value="" placeholder="">
                            <label>Confirm the password:</label>
                            <input class="form-control" type="password" name="confirmPassword" value="" placeholder="">
                            <button type="button" class="btn btn-success" id="nextCompany" style="margin-top:25px">Next Step</button>
                        </div>
                        <div class="form-group" style="display: none" id="restCompany">
                            <label>Company Name:</label>
                            <input class="form-control" type="text" name="companyName" value="" placeholder="">
                            <label>Industry Segment:</label>
                            <input class="form-control" type="text" name="professionalGroup" value="" placeholder="">
                            <label>Country:</label>
                            <input class="form-control" type="text" name="country" value="" placeholder="">
                            <button type="button" class="btn btn-success" id="prevCompany" style="margin-top:25px">Go back!</button>
                            <input type="submit" id="button2" class="btn btn-success" value="Submit" style="margin-top:25px">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET["register"])) {
            $user_role = $_GET["register"];
            ?>
            <script>
                $("#registerOptions").hide();
            </script>
            <?php
            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == 'POST') {

                $servername = "localhost";
                $db_username = "root";
                $db_password = "ev2015";
                $db_name = 'mydb';

                // Create connection
                $conn = new mysqli($servername, $db_username, $db_password, $db_name);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } else {
                    //register user/company
                    //common fields
                    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
                    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
                    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                    $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
                    $professionalGroup = filter_input(INPUT_POST, 'professionalGroup', FILTER_SANITIZE_STRING);

                    if ($user_role == 0) {
                        //register a user

                        $skills = filter_input(INPUT_POST, 'setSkills', FILTER_SANITIZE_STRING);
                        $date = filter_input(INPUT_POST, 'birthDate', FILTER_SANITIZE_STRING);
                        $fileName = $_FILES['userfile']['name'];
                        $tmpName = $_FILES['userfile']['tmp_name'];
                        $fileSize = $_FILES['userfile']['size'];
                        $fileType = $_FILES['userfile']['type'];

                        $fp = fopen($tmpName, 'r');
                        $content = fread($fp, filesize($tmpName));
                        $content = addslashes($content);
                        fclose($fp);

                        if (!get_magic_quotes_gpc()) {
                            $fileName = addslashes($fileName);
                        }

                        $d = new DateTime($date);
                        $formatted_date = $d->format('Y-m-d');

                        $sql_query = "INSERT INTO users(user_role, first_name, last_name, email, password, industry_segment, country, cv, size, type, name, skills, birth_day)" .
                                "Values('$user_role','$firstName', '$lastName', '$email', '$password', '$professionalGroup', '$country', '$content', '$fileSize', '$fileType', '$fileName', '$skills', '$formatted_date')";
                    } else if ($user_role == 1) {
                        //register a company
                        $companyName = filter_input(INPUT_POST, 'companyName', FILTER_SANITIZE_STRING);

                        $sql_query = "INSERT INTO users(user_role, first_name, last_name, email, password, industry_segment, country, company_name)" .
                                "Values('$user_role','$firstName', '$lastName', '$email', '$password', '$professionalGroup', '$country', '$companyName')";
                    }

                    $result = $conn->query($sql_query);
                    if ($result) {
                        //redirect
                        //echo("<script>location.href = '/evr/ev_login_users/signin.php';</script>");
                        if($user_role == 0)
                            include('upload_evr.php');
                        echo("<script>location.href = './signin.php';</script>");
                    } else {
                        //e-mail already in use
                        // echo "<script>history.go(-1);</script>";
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

                        <div class="container">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-5">
                                    <a class="btn btn-primary" href="register.php" style="width:100%">Try again!</a>
                                </div>
                            </div>
                        </div>
                <?php
            }
        }
    }
}
?>
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