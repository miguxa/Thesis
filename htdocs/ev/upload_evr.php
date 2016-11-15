<?php
$target_dir = "C:\\ev\\xampp\\htdocs\\ev\\cvs\\";
$target_file = $target_dir . basename($email."-".$_FILES["userfile"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
			//success
    } else {
        echo "Sorry, there was an error saving your file.";
    }

?>