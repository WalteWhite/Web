<?php
    require_once("session.php");
?>

<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once('mysql_config.php');

    //$_GET['bno']이 있을 때만 $bno 선언

    $dbc = mysqli_connect($host, $user, $pass)
      or die("DB 연결 실패");
    mysqli_query($dbc,'set names utf8');
    mysqli_select_db($dbc,"gctravel");

    if(isset($_GET['bno'])) {
      $bNo = $_GET['bno'];
    }


    if(isset($bNo)) {
      $sql = 'select b_title, b_content, id from board where b_num = ' . $bNo;
      $result = $dbc->query($sql);
      $row = $result->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GC Travel | POST</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/clean-blog.min.css" rel="stylesheet">
    <link href="css/board.css" rel="stylesheet">

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
    #btn {
      -webkit-transition-duration: 0.4s; /* Safari */
      transition-duration: 0.4s;
      background-color: white;
      width: 270px;
      height: 50px;
    }
    #btn:hover {
    background-color: #4CAF50; /* Green */
    color: white;
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
                        <span class="subheading">Write</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                  <article class="boardArticle">
                        <form action="write_update.php" method="post">
                          <table id="boardWrite">
                            <?php
                            require_once('mysql_config.php');

                            $dbc = mysqli_connect($host, $user, $pass)
                              or die("DB 연결 실패");
                            mysqli_query($dbc,'set names utf8');
                            mysqli_select_db($dbc,"gctravel");

                            if (!isset($_SESSION['id'])){
                              exit('<a href = "javascript:history.go(-1)">
                              <center>로그인을 해야 글을 쓸수 있습니다.</center> <br>
                              <center>누르면 이전 페이지로 되돌아갑니다.</center></a>');
                            }

                             ?>

                             <?php
                      				if(isset($bNo)) {
                      					echo '<input type="hidden" name="bno" value="' . $bNo . '">';
                      				}
                      				?>

                            <caption class="readHide"><center>자유게시판 글쓰기</center></caption>
                              <tbody>
                                <tr>
                                  <th scope="row"><label for="bID">아이디</label></th>
                                  <?php
                                  echo '<td>'.$id.'</td>';
                                   ?>
                                  <!--<td class="id"><input type="text" name="bID" id="bID"></td>-->
                                </tr>

                                <tr>
                                  <th scope="row"><label for="bPassword">비밀번호</label></th>
                                  <td class="password"><input type="password" class="form-control" name="bPassword" id="bPassword"
                                    value="<?php echo isset($row['b_title'])?$row['b_title']:null?>"></td>
                                </tr>

                                <tr>
                                  <th scope="row"><label for="bTitle">제목</label></th>
                                  <td class="title"><input type="text" class="form-control" name="bTitle" id="bTitle"></td>
                                </tr>

                                <tr>
                                  <th scope="row"><label for="bContent">내용</label></th>
                                  <td class="content"><textarea name="bContent" class="form-control" id="bContent">
                                    <?php echo isset($row['b_content'])?$row['b_content']:null?>
                                  </textarea></td>
                                  
                                </tr>
                              </tbody>
                            </table>
                              <button type="submit" class="btnSubmit btn">
                              <?php echo isset($bNo)?'수정':'작성'?></button>
                              <a href="post.php">글목록</a>

                          </form>
                      </article>
                  </div>
            </div>
        </div>
    </article>

    <hr>

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
                    <p class="copyright text-muted">Copyright &copy; Your Website 2016</p>
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
