<?php
if (isset($_GET["idwork"])) {
    $work_id = $_GET["idwork"];
    $user_id = $_SESSION["user_id"];
}
?>
<div class="container">
    <div class="row">
        <div>
            <table cellspacing="1" align="center">
                <form method="post" action="home.php?op=subscribeQuery&idwork=<?php echo $work_id; ?>&user_id=<?php echo $user_id; ?>">
                    <br>
                    Motivation Letter:
                    <br>
                    <textarea name="motivation" rows="15" cols="100"></textarea>
                   
                    <!--<br>
                    Insert your CV	
                    <br>
                    <input type="file" name="arquivo" />-->
                    <br>	
                    <input type='submit' class="btn btn-success btn-sm" value='Submit' id='sumbitButton'>
                    <br>
                    <br>

                </form>
            </table>			
        </div>
    </div>
</div>