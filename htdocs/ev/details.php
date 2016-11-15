<?php
if (isset($_GET['data'])) {
    $userid = $_GET["data"];

    $stringQuery = "SELECT * FROM Users WHERE id_user=";
    $stringQuery.=$userid;
    $conn = mysqli_connect("localhost", "root", "ev2015", "mydb");

// Check connection
    if (mysqli_connect_errno()) {
        echo json_encode("Failed to connect to MySQL: " . mysqli_connect_error());
    } else {
        $result = mysqli_query($conn, $stringQuery);
        $profile = mysqli_fetch_array($result);
        $first_name = $profile['first_name'];
        $last_name = $profile['last_name'];
        $email = $profile['email'];
        $company_name = $profile['company_name'];
        $industry_segment = $profile['industry_segment'];
        $country = $profile['country'];
        $skills = $profile['skills'];
        $myskills = explode(",", $skills);






        $conn->close();
    }
}
if (isset($_GET['cv'])) {
    echo $cv;
}
?>
<script>
    function myFunction() {
        
        window.location = "home.php?op=downloadCV" + "&data=" +<?php echo $userid; ?>;
    }
    $(document).ready(function () {

        $('#SkillsTags').tagit({
            readOnly: true
        });

<?php
for ($i = 0; $i < count($myskills); $i++) {
    echo '$("#SkillsTags").tagit("createTag", "' . $myskills[$i] . '");';
}
?>
    });
</script>
<div id="container" class="col-md-6 col-md-offset-3">
    <ul class="list-group">
        <li class="list-group-item"><b>First Name:</b> <?php echo $first_name; ?></li>
        <li class="list-group-item"><b>Last Name:</b> <?php echo $last_name; ?></li>
        <li class="list-group-item"><b>Email:</b> <?php echo $email; ?></li>
        <li class="list-group-item"><b>Company:</b> <?php echo $company_name; ?></li>
        <li class="list-group-item"><b>Industry:</b> <?php echo $industry_segment; ?><br></li>
        <li class="list-group-item"><b>Country:</b> <?php echo $country; ?><br></li>
        <li class="list-group-item"><b>Competences:</b><ul id="SkillsTags"></ul><br></li>
        <li class="list-group-item"><button onclick="myFunction()">Download cv</button></li>
        <li class="list-group-item"><button><a href="mailto:<?php echo $email; ?>">Contactar</a></button></li>
    </ul>
</div>



