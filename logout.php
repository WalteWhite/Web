<!-- 17.5.25 로그아웃 태스트 및 배치
  나중에 onclick 기능으로 추가예정-->
<?php
  require_once("session.php");
 ?>
 <?
   error_reporting(E_ALL);
   ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript">


    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CG Travel | logout</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style media="screen">


    footer{
      margin: 200px 0 0 0;
    }
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">GC Travel</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                  <li>
                      <a href="index.php">Home</a>
                  </li>
                  <li>
                      <a href="Travel.php">Travel</a>
                  </li>
                  <li>
                      <a href="post.php">Post</a>
                  </li>
                  <li>
                      <a href="support.php">Support</a>
                  </li>
                    <?php

                    if (!isset($_SESSION['email'])){
                      echo '<li>
                          <a href="login.html">Login</a>
                      </li>';
                    }
                    else {
                      echo '<li>
                          <a href="logout.php">Logout</a>
                      </li>';
                    }

                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>GC Travel</h1>
                        <hr class="small">
                        <span class="subheading">Login</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
              <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">


                <?php
                require_once('mysql_config.php');

                if(!isset ($_SESSION['id'])){
                  exit('<a href = "javascript:history.go(-1)">
                  <center>로그인 상태가 아닙니다.</center> <br>
                  <center>누르면 로그인 페이지로 되돌아갑니다.</center></a>');
                }

                $_SESSION = array();
                if(isset ($_COOKIE [session_name()])) {
                  setcookie(session_name(), '', time() - (60*60));
                }

                session_destroy();

                setcookie('id', '', time() - (60*60));


                echo '<a href = "index.php">
                <center>로그아웃 되었습니다.</center> <br>
                <center>누르면 홈페이지로 되돌아갑니다.</center></a>'
                ?>


              </div>
        </div>
  </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <p class="copyright text-muted">Copyright &copy; GC Company 2017</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/clean-blog.min.js"></script>

</body>

</html>
