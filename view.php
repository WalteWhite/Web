<!-- 17.5.3 로그인화면 만드는중 -->

<?php
    require_once("session.php");
?>

<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once('mysql_config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CG Travel | POST</title>

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


      #boardinfo{
        margin: 30px 0 0 0;
      }
      .viewdate{
        margin: 0 0 0 20px;
      }
      .viewhit{
        margin: 0 0 0 20px;
      }
      .viewcontent{
        margin: 30px 0 0 0;
      }
      .viewbtn{
        background-color: #EAEAEA;
        margin: 100px 0 0 0;
      }

      .commentdiv{
        margin: 200px 0 0 0;
      }

      footer{
        margin: 100px;
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
                <a class="navbar-brand" href="index.php">GC Travel</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                  <?php

                  $dbc = mysqli_connect($host, $user, $pass)
                    or die("DB 연결 실패");
                    mysqli_query($dbc,'set names utf8');
                    mysqli_select_db($dbc,"gctravel");


                  if (!isset($_SESSION['id'])){

                  }
                  else {
                    $id = $_SESSION['id'];
                    echo '<li>
                            <a href="profile.php">'.$id.'님</a>
                          </li>';
                  }
                   ?>

                  <!-- 로그인 세션 부분-->

                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="travel.php">Travel</a>
                    </li>
                    <li>
                        <a href="post.php">Post</a>
                    </li>
                    <li>
                        <a href="support.php">Support</a>
                    </li>

                    <?php
                    if (!isset($_SESSION['id'])){
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
                        <span class="subheading">Board View</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
              <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

                <?php

                $dbc = mysqli_connect($host, $user, $pass)
                  or die("DB 연결 실패");
                mysqli_query($dbc,'set names utf8');
                mysqli_select_db($dbc,"gctravel");

                $bNo = $_GET['bno'];

                if(!empty($bNo) && empty($_COOKIE['board_' . $bNo])) {
                  $sql = 'update board set b_hit = b_hit + 1 where b_num = ' . $bNo;
                  $result = $dbc->query($sql);
                  if(empty($result)) {
                    ?>

                    <script>
                    alert('오류가 발생했습니다.');
                    history.back();
                    </script>

                    <?php
                  } else {
                    setcookie('board_' . $bNo, TRUE, time() + (60 * 60 * 24), '/');
                  }
                }


                $sql = 'select b_title, b_content, b_date, b_hit, id from board where b_num = ' . $bNo;
                $result = $dbc->query($sql);
                $row = $result->fetch_assoc();

                ?>

                <article class="boardart">
                    <div id="boardview">

                    <h3 id="boardTitle"><?php echo '<center>'.$row['b_title'].'</center>'?></h3>
                    <hr>

                    <div id="boardinfo">
                    <span class="viewid"><h5>아이디: <?php echo $row['id']; if(empty($row['id'])){echo "탈퇴회원";}?></span>
                    <span class="viewdate">작성일: <?php echo $row['b_date']?></span>
                    <span class="viewhit">조회: <?php echo $row['b_hit']?></h5></span>
                    </div>

                    <div class="viewcontent"><?php echo $row['b_content']?></div>


                    <script type="text/javascript">
                    function linkmodify(){
                      location.href = "write.php?bno=<?php echo $bNo?>";
                    }
                    function linkdelete(){
                      location.href = "delete.php?bno=<?php echo $bNo?>";
                    }
                    function linklist(){
                      location.href = "post.php";
                    }
                    </script>
                    <div class="commentdiv">
                    <hr>
                    <?php
                      require("comment.php");
                     ?>
                   </div>

                    <div class="viewbtn">
                    <center><input type="button" class="btn btn-default btn-sm btn-block" name="btn" value="수정" id="btn" onclick="linkmodify(); return false;"></center>
                    <center><input type="button" class="btn btn-default btn-sm btn-block" name="btn" value="삭제" id="btn" onclick="linkdelete(); return false;"></center>
                    <center><input type="button" class="btn btn-default btn-sm btn-block" name="btn" value="목록" id="btn" onclick="linklist(); return false;"></center>
                    </div>
                    </div>
                </article>
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
