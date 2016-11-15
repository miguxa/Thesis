<?php
if (!isset($_SESSION["user_logged"])) {
    //page that we want to redirect
    header("Location: signin.php");
    die();
}


$workid = $_GET["idwork"];

$stringQuery = "SELECT * FROM publish WHERE id_work=".$workid;
$stringQuerySubscribe="SELECT * FROM subscribe WHERE publish_id_work=".$workid." and users_id_user=".$_SESSION["user_id"];
$conn = mysqli_connect("localhost", "root", "ev2015", "mydb");

// Check connection
if (mysqli_connect_errno()) {
    echo json_encode("Failed to connect to MySQL: " . mysqli_connect_error());
} else {
    $result = mysqli_query($conn, $stringQuery);
    $resultsubscribe = mysqli_query($conn, $stringQuerySubscribe);
    $SubscribeResult = mysqli_fetch_array($resultsubscribe);
    if (count($SubscribeResult) > 0) {
        $subscribed=true;
    }
    else{
         $subscribed=FALSE;
    }
    $profile = mysqli_fetch_array($result);
    $job_title = $profile['job_title'];
    $contact_information = $profile['contact_information'];
    $start_date = $profile['start_date'];
    $location = $profile['location'];
    $deadline_app = $profile['deadline_app'];
    $job_length = $profile['job_length'];
    $budget = $profile['budget'];
    $description = $profile['description'];
    //$keywords = $profile['keywords'];

    $budgetMinRange = $profile['budgetMinRange'];
    $budgetMaxRange = $profile['budgetMaxRange'];
    $partTime = $profile['partTime'];
    $periodType = $profile['periodType'];
    $lengthJobType = $profile['lengthJobType'];
    $descriptionLanguage = $profile['descriptionLanguage'];
    $reqSkills = $profile['reqSkills'];
    $LanguagesSpoken = $profile['LanguagesSpoken'];

    $conn->close();
}
?>
<!DOCTYPE html>


<script type="text/javascript">
    $(document).ready(function () {
        $("#subscribebutton").click(function () {
       
            var user = <?php echo $_SESSION["user_id"] ?>;
            var work = <?php echo $workid ?>;
           
            window.location = "home.php?op=subscribe" + '&user_id=' + user + '&idwork=' + work;
        });

    });


</script>



<div id="container" class="col-md-6 col-md-offset-3">
    <h1>Details</h1>
    <div id='TextBoxesGroup'>
    </div>
    <br>
    <table class="table" id="records_table" style="margin-bottom:100px">
        <tbody>
            <tr>
                <td>Job title: </td><td><?php echo $job_title; ?></td>
            </tr>
            <tr>
                <td>Contact:</td><td> <?php echo $contact_information; ?></td>
            </tr>
            <tr>
                <td>Start date:</td><td> <?php echo $start_date; ?></td>
            </tr>
            <tr>
                <td>Location:</td><td> <?php echo $location; ?></td>
            </tr>
            <tr>
                <td>Deadline</td><td> <?php echo $deadline_app; ?></td>
            </tr>
            <tr>
                <td>Duration:</td><td> <?php
                    echo $job_length;
                    echo $lengthJobType;
                    ?></td>
            </tr>
            <tr>
                <td>Part-Time:</td><td> <?php echo $partTime ?>hour(s) per day</td>
            </tr>
            <tr>
                <td>Budget:</td><td> <?php
                    echo $budgetMinRange;
                    echo ' - ';
                    echo $budgetMaxRange;
                    echo $budget;
                    ?> per <?php echo $periodType ?></td>
            </tr>
            <tr> 
                <td>Description Language:</td><td><?php echo $descriptionLanguage; ?></td>
            </tr>
            <tr>
                <td>Description:</td> <td><?php echo $description; ?></td>
            </tr>
            <tr>
                <td>Skills:</td> <td><?php echo $reqSkills; ?></td>
            </tr>
            <tr>
                <td>Languages Spoken:</td> <td><?php echo $LanguagesSpoken; ?></td>
            </tr>
            <tr>
                <td><button type="button"><a href="mailto:<?php echo $contact_information; ?>">Contact</a></button> </td> 
                <td><button type="button" class="btn btn-primary btn-sm" id="subscribebutton"> Subscribe Offer</button> </td>
            </tr>
        </tbody>
    </table>
   
    
</div>


<?php

if($subscribed){
    echo "<script> $('#subscribebutton').attr('disabled', true);</script>";
}
else{
     echo "<script> $('#subscribebutton').attr('disabled', false);</script>";
}
    



?>