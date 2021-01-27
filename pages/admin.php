<?php
    include('functions.php');

    if (!isAdmin()) {
        $_SESSION['erreur'] = "vous devriez être connecté et être un administrateur";
        header('location: ../index.php');
    }
?>


<!doctype html>
<html class="no-js" lang="en">

<head>
    <?php require("../header/header_Admin.php"); ?>
    <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
</head>

<body>

    <!-- Panel de gauche -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="../images/istc1.png" class="rounded-circle" style="width: 35%" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">

                <ul class="nav navbar-nav">
                    <h3 class="menu-title">Gestionnaire</h3><!-- /.menu-title -->
                    <li class="menu">
                        <a href="bureaux.php" class="dropdown-toggle"> <i class="menu-icon fa fa-table"></i>Bureaux et Services</a>
                    </li>

                    <li class="menu">
                        <a href="user.php" class="dropdown-toggle"> <i class="menu-icon fa fa-user"></i>Utilisateurs</a>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Matériels</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-laptop"></i><a href="page_info.php">Informatique</a></li>
                        </ul>
                    </li>

                    <li class="menu">
                        <a href="intervention.php" class="dropdown-toggle" > <i class="menu-icon fa fa-shopping-cart"></i>Interventions</a>
                    </li>

                    <li class="menu">
                        <a href="attribut.php" class="dropdown-toggle" ><i class="menu-icon ion-md-shuffle"></i>Attributions</a>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->


    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">

                        <!--     repere -->
                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-email"></i>
                                <span class="count bg-primary"></span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message" id="dropdown-menu"></div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="../images/tepi.JPG" style="width: 6%" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="utilisateurs.php"><i class="fa fa-user"></i> Mon profile</a>
                            <a class="nav-link" href="deconnexion.php"><i class="fa fa-power-off"></i> Deconnexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </header><!-- /header -->
        <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Parc Informatique</h1>
                    </div>
                </div>
            </div>
        </div>



        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../images/istc.jpg" class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="../images/info.jpg" class="d-block w-100" alt="...">
                </div>

                <div class="carousel-item">
                    <img src="../images/inf3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        

        
    <script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>

    <?php require("../footer/footer_Admin.php"); ?>

</body>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>


    <script type="text/javascript">
        $('document').ready(function(){


        function charger_notification_non_lue(view = '') {
     
        $.ajax({
                url: "/Stage_ISTC/pages/test_notification.php",
                method: 'GET',
                data: {
                        view:view
                    },
                dataType: 'json',
                success: function(data){
                        
                            $('#dropdown-menu').html(data.sujet);
                        
                        
                        if(data.notification_non_lue>0){
                           $('.count').html(data.notification_non_lue); 
                        }
                        
                },
                error: function(resultat){
                    console.log(resultat.responseText)
                }
            });
        }

        $(document).on('click','#dropdown-item' ,function(){
            

            $('.count').html('0');
            charger_notification_non_lue('oui');
               window.location = "intervention.php";

        });

         setInterval(function(){
            charger_notification_non_lue();
         }, 5000);
        });
    </script>
</html>
