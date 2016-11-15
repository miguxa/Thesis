<?php
//start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["user_logged"])) {
    //page that we want to redirect
    header("Location: signin.php");
    die();
}
?>




<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Publish a Job</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <!-- Custom styles for this template -->
        <link href="sticky-footer.css" rel="stylesheet">
    </head>
    <body>		

 		


        <?php
        if (isset($_GET["insert"])) {

            $insert = $_GET["insert"];

            if ($insert == 1) {


                $job_title = $_POST['jobTitle'];
                $job_location = $_POST['jobLocation'];
                $contact = $_POST['contactInfo'];
                $start_date = $_POST['startDate'];
                $deadline = $_POST['deadline'];
                $length = $_POST['lengthJob'];
                $id = $_SESSION["user_id"];
                $budget = $_POST['currency'];
                $description = $_POST['description'];

                $partTime = $_POST['partTime'];
                $periodType = $_POST['periodType'];
                $lengthJobtype = $_POST['lengthJobtype'];
                $minRange = $_POST['minRange'];
                $maxRange = $_POST['maxRange'];
                $desciptLanguage = $_POST['desciptLanguage'];
                
                $reqSkills = implode ( ",", $_POST['reqSkills']);
                $langSpoken = implode ( ",", $_POST['langSpoken']);
                
                $connect = mysqli_connect('localhost', 'root', 'ev2015')
                        or die('Não foi possível conectar: ' . mysql_error());
                mysqli_select_db($connect, 'mydb')
                        or die('Não foi possível seleccionar o banco da dados');

                $sql = 'Insert into publish (job_title,contact_information,start_date, location,deadline_app,job_length,budget,description,available,Users_id_user,budgetMinRange,budgetMaxRange,partTime,periodType,lengthJobType,descriptionLanguage,reqSkills,LanguagesSpoken) VALUES("' . $job_title . '" ,"' . $contact . '","' . $start_date . '","' . $job_location . '","' . $deadline . '","' . $length . '" ,"' . $budget . '","' . $description . '",1,"' . $id . '","' . $minRange .'","' . $maxRange . '","' . $partTime . '","' . $periodType . '","' . $lengthJobtype . '","' . $desciptLanguage . '","' . $reqSkills . '","' . $langSpoken . '")';
                $result = mysqli_query($connect, $sql)
                        or die('A consulta falhou!: ' . mysqli_error($connect));


                echo " </br>  </br> <H3 >  Job susccessfully attached. Redirecting to Home page... </H3> ";
                echo'<script>setTimeout(function(){ window.location = "./home.php"; }, 1500);</script>';
            } else
                echo "Missing page, try another";
        }
        ?>







        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Publish a Job</h1>

                    <form action ="pub.php?insert=1" name="publishJob"  method="POST">
                        <br>
                        Job Title*: <input class="form-control" type="TEXT" name="jobTitle" placeholder="Enter Job Title here" value="" required><p><p>

                            Location of the job: <p>
                        <input type="RADIO" name="jobLocation" value="Distance Working" required> Distance Working <p> 
                        <input type="RADIO" name="jobLocation" value="To be determined" required> To be determined<p>
                        <input type="RADIO" name="jobLocation" value="Fixed location" required> Fixed location<p><p>

                            Contact Information*: <input class="form-control" type="TEXT" name="contactInfo" value="" required><p><p>

                            Estimated Start Date*: <input class="form-control" type="DATE" name="startDate" value="" required><p>

                            Deadline for application: <input class="form-control" type="DATE" name="deadline" value="" required><p>

                            Length of job*: <input type="TEXT" name="lengthJob" value="" required> &nbsp &nbsp
                            <select name="lengthJobtype" required>
                                <option value="days">Days</option>
                                <option value="months">Months</option>
                                <option value="years">Years</option>
                            </select><p><p>

                            Part-time: <input type="TEXT" name="partTime" value="" > &nbsp &nbsp hour(s) per day <p>

                            Budget Range*: &nbsp &nbsp rate per: 
                            <select name="periodType" required>
                                <option value="hours">Hours</option>
                                <option value="days">Days</option>
                                <option value="months">Months</option>
                                <option value="projects">Projects</option>
                            </select> 
                            &nbsp &nbsp Currency &nbsp &nbsp
                            <select name = "currency">
                                <option value="euros">EUR - €</option>
                                <option value="dollars">USD - $</option>
                            </select> <p>

                            Please indicate the budget range for this job <p>
                            <!-- <form class="form-inline">-->
                        <div class="col-md-6">
                            € <input type="number" class="form-control" style="width:20%" name="minRange"> /Hour
                        </div>
                        <div class="col-md-6">
                            € <input type="number" class="form-control" style="width:20%" name="maxRange" > /Hour
                        </div>
                        <!--</form> -->

                        Description Language*:
                        <select class="form-control" name="desciptLanguage" required>
                            <option value="english">English</option>
                            <option value="portuguese">Portuguese</option>
                        </select> <p> <P>

                            Description*: <p>
                            <textarea class="form-control" rows="4" cols="50" name="description" >	</textarea> <p><p>

                            Required Skills (Hold down the Ctrl button to select multiple options):<p>
                            <select class="form-control" name="reqSkills[]" multiple>
                                <option>Software Development</option>
                                <option>Data Mining</option>
                                <option>Project Management</option>
                                <option>Quality Control</option>
                            </select> <p> <P>

                            Required Languages Spoken (Hold down the Ctrl button to select multiple options):<p>
                            <select class="form-control" name="langSpoken[]" multiple>
                                <option>English</option>
                                <option>Spanish</option>
                                <option>Portuguese</option>
                                <option>French</option>
                                <option>Russian</option>
                                <option>German</option>
                            </select> <p> <P>		

                            <input class="btn btn-primary" type="submit" value="Submit" />
                    </form>
                </div>
            </div> 
            <hr>
        </div>




    </body>
</html>
