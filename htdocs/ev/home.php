<?php
session_start();

if (isset($_SESSION["user_logged"])) {

    $_MAIL = $_SESSION["user_mail"];
}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Virtual Enterprises</title>
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <!-- Custom styles for this template -->
        <link href="./sticky-footer.css" rel="stylesheet">


        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>


        <script src="./tag_it/js/tag-it.js"></script>
        <link rel="stylesheet" href="./tag_it/css/jquery.tagit.css" />

        <link rel="stylesheet" href="./tag_it/css/tagit.ui-zendesk.css" />
    </head>
    <body>

        <!-- php para ver qual iremos mostrar -->
        <?php
        if (isset($_SESSION["user_logged"])) {
            $user_id = $_SESSION["user_id"];
            $user_role = $_SESSION["user_role"];
            //user_role = 0 ---> é um trabalhador
            //user_role = 1 ---> é uma empresa
            if ($user_role == 1) {
                //view para mostrar aos empregadores
                //o action fica ao vosso dispor (se quiserem manter este formato obvio)
                ?>
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
                            <a href="./home.php">
                                <img alt="Brand" src="img/brand.png">
                            </a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color: white">Publications <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a onClick="location.href = 'home.php?op=my_publications&userid=' +<?php echo $user_id; ?>" >My publications</a>
                                        </li>
                                        <li>
                                            <a onClick="location.href = 'home.php?op=new_publication&userid=' +<?php echo $user_id; ?>" >New publication</a>
                                        </li>

                                    </ul>
                                </li>
                                <li> 
                                    <a href = 'home.php?op=view_advanced_search&userid='style="color: white">Advanced Search</a>
                                </li>
                                <li> 
                                    <a onClick="location.href = 'home.php?op=About'" style="color: white">About</a>
                                </li>
                                <li>
                                    <a style="color: white" href="editprofile.php" style="color: white"> Edit profile</a>
                                </li>
                                <li>
                                    <a style="color: white" href="logout.php" style="color: white"> Logout</a>
                                </li>

                                <li>
                                    <!--
                                    <p style="color: white" valign="middle" >

                                                          
            
          </p>-->

                                </li>
                            </ul>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                 <ul class="nav navbar-nav">
                                 </ul>
                                 <ul class="nav navbar-nav navbar-right">-->
                            <!--   <li >
                            <!--    <a style="color: white" href="#"  aria-expanded="false">
                            
                                   &nbsp
                                   <span class="caret"></span>
                               </a>
                            <!--  <ul class="dropdown-menu" role="menu">
                                  <li>
                                      <a href="editprofile.php">Edit profile</a>
                                  </li>
                              </ul>-->
                            </li>
                            <!-- <li>
                                 <a style="color: white" href="logout.php"> Logout</a>
                             </li>-->
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>



            </div>
            <div class="container">
                <div class='row'>
                    <?php
                    if (isset($_GET["op"])) {
                        $operacao = $_GET["op"];
                        switch ($operacao) {
                            case "view_advanced_search":
                                include './AdvancedUserSearch.php';
                                break;
                            case "view_advanced_search_details":
                                include './details.php';
                                break;
                            case "downloadCV":
                                include './downloadCV.php';
                                break;
                            case "new_publication":
                                include './pub.php';
                                break;
                            case "my_publications":
                                include './MyPublications.php';
                                break;
                            case "my_publications_details_edit":
                                include './MyPublicationsEdit.php';
                                break;
                            case "About":
                                include './About.php';
                                break;
                            case "show_subscribed_user":
                                include './showUser.php';
                                break;
                            default:
                                break;
                        }
                    } else {
                        echo "<h4 align='center'>  Welcome  $_MAIL </h4> </br>";
                        echo'<div class="col-md-6"><img src="http://s3.amazonaws.com/libapps/accounts/30816/images/109f543.jpg"  width="100%" height="100%"></div>
                    <div class="col-md-6"><img src="http://changeyourteam.com/wp-content/uploads/2013/05/welcome-blog-shutterstock_136537196.jpg" width="100%" height="100%"></div>';
                    }
                    ?>
                </div>
            </div>

            <?php
        } else if ($user_role == 0) {
            //view para mostrar aos trabalhadores
            //o action fica ao vosso dispor (se quiserem manter este formato obvio)
            ?>
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
                        <a href="./home.php">
                            <img alt="Brand" src="img/brand.png">
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li> 
                                <a onClick="location.href = 'home.php?op=view_my_subscriptions&userid=' +<?php echo $user_id; ?>" style="color: white">My Subscriptions</a>
                            </li>
                            <li> 
                                <a onClick="location.href = 'home.php?op=view_matching&userid=' +<?php echo $user_id; ?>" style="color: white">Smart Matching</a>
                            </li>
                            <li> 
                                <a onClick="location.href = 'home.php?op=view_advanced_search&userid='" style="color: white">Advanced Search</a>
                            </li>
                            <li> 
                                <a onClick="location.href = 'home.php?op=About'" style="color: white">About</a>
                            </li>
                            <li> 
                                <a onClick="location.href = 'editprofile.php'" style="color: white"> Edit profile</a>
                            </li>

                            <li> 
                                <a onClick="location.href = 'logout.php'" style="color: white"> Logout</a>
                            </li>

                        </ul>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                             <ul class="nav navbar-nav">
                             </ul>
                             <ul class="nav navbar-nav navbar-right">
                                 <li class="dropdown">
                                     <a style="color: white" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        // <?php
                        // if (isset($_SESSION["user_logged"])) {
                        //     echo $_SESSION["user_mail"];
                        //  }
                        ?>
                                         &nbsp
                                         <span class="caret"></span>
                                     </a>
                                     <ul class="dropdown-menu" role="menu">
                                         <li>
                                             <a href="editprofile.php">Edit profile</a>
                                         </li>
                                     </ul>-->
                        </li>
                        <!--  <li>
                             <a style="color: white" href="logout.php"> Logout</a>
                         </li> -->
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>	

            <?php
            if (isset($_GET["op"])) {
                $operacao = $_GET["op"];
                switch ($operacao) {
                    case "view_advanced_search":
                        include './PublishHome.php';
                        break;
                    case "view_advanced_search_details":
                        include './Publishdetails.php';
                        break;
                    case "view_my_subscriptions":
                        include './Mysubscriptions.php';
                        break;
                    case "view_matching":
                        include './Matching.php';
                        break;
                    case "view_matching_company_detais":
                        include './CompanyDetails.php';
                        break;
                    case "view_publish_details":
                        include './Publishdetails.php';
                        break;
                    case "subscribe":
                        include './SubmitSubscriptionForm.php';
                        break;
                    case "subscribeQuery":
                        include './SubscriptionQuery.php';
                        break;
                    case "About":
                        include './About.php';
                        break;
                    case "delete_subscribe":
                        include './DeleteSubscribe.php';
                        break;
                    default:
                        break;
                }
            } else {

                echo "<h4 align='center'>  Welcome  $_MAIL </h4> </br>";
                echo'<div class="col-md-6"><img src="http://s3.amazonaws.com/libapps/accounts/30816/images/109f543.jpg"  width="100%" height="100%"></div>
                    <div class="col-md-6"><img src="http://changeyourteam.com/wp-content/uploads/2013/05/welcome-blog-shutterstock_136537196.jpg" width="100%" height="100%"></div>';
                }
            ?>


            <?php
        }
    } else {
        ?>
        <script type="text/javascript">
            $("#userOptionsNav").hide();
        </script>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-danger" role="alert" style="text-align: center">
                        <span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span>
                        Oh snap! The content you are trying to access is only for users that are registered! Please
                        <a href="signin.php" class="alert-link">Log in</a> or 
                        <a href="register.php" class="alert-link">Join us</a>!
                    </div>
                </div>
            </div>		
        </div>		
        <?php
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