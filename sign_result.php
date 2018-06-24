<!-- 17.5.3 로그인화면 만드는중
      17.5.24 이미지 업로드 기능 만드는중-->

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

    <title>CG Travel | Sign in</title>

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
                <a class="navbar-brand" href="index.php">GC Travel</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="travel.php">Travel</a>
                    </li>
                    <li>
                        <a href="post.html">Post</a>
                    </li>
                    <li>
                        <a href="support.php">Support</a>
                    </li>
                    <li>
                        <a href="login.html">Login</a>
                    </li>
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
                        <span class="subheading">New Membership</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
              <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">


                <?php
                    error_reporting(E_ALL);
                    ini_set("display_errors", 1);
                    require_once('mysql_config.php');

                    if(empty ($_POST['id']) || empty ($_POST['password']) || empty ($_POST['repassword']) || empty ($_POST['username']) || empty ($_POST['nickname'])
                    || empty ($_POST['question']) || empty ($_POST['answer'])){
                      exit('<a href = "javascript:history.go(-1)">
                      <center>회원가입 폼을 모두채워주세요</center> <br>
                      <center>누르면 회원가입 페이지로 되돌아갑니다.</center></a>');
                    }
                    if($_POST['password'] != $_POST['repassword']){
                      exit('<a href = "javascript:history.go(-1)">
                      <center>비밀번호가 일치하지 않습니다.</center> <br>
                      <center>누르면 회원가입 페이지로 되돌아갑니다.</center></a>');
                    }

                    if ($_FILES["pic"]["size"] > 500000) {
                      exit('<a href = "javascript:history.go(-1)">
                      <center>프로필 사진은 500KB 이하로 해주세요.</center> <br>
                      <center>누르면 회원가입 페이지로 되돌아갑니다.</center></a>');
                    }



                  $dbc = mysqli_connect($host, $user, $pass)
                    or die("DB 연결 실패");
                  mysqli_query($dbc,'set names utf8');
                  mysqli_select_db($dbc,"gctravel");


                   //회원가입 DB에 넣기---------------------------------------------------------

                   $id = mysqli_real_escape_string($dbc, trim($_POST['id']));
                   $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
                   $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
                   $nickname = mysqli_real_escape_string($dbc, trim($_POST['nickname']));
                   $question = mysqli_real_escape_string($dbc, trim($_POST['question']));
                   $answer = mysqli_real_escape_string($dbc, trim($_POST['answer']));
                   $img = addslashes(file_get_contents($_FILES['pic']['tmp_name']));


                   // $가 있으면 " " 쓸것
                   $query = "select id from membership where id='$id'";
                   $result = mysqli_query($dbc, $query)
                    or die("id 중복확인 실패");

                  //여기 부분은 나중에 스크립트 적용해서 메세지박스로 출현시키자
                  if(mysqli_num_rows($result) != 0){
                      exit(/*echo'<script>alert('이미 있는 아이디입니다.'); history.back(); </script>';
                      exit; 여기 Alert 부분이 왜 안되는지 모르겠다.*/
                      '<a href = "javascript:history.go(-1)">
                    <center>이미 등록한 회원입니다.</center> <br>
                    <center>누르면 회원가입 페이지로 되돌아갑니다.</center></a>');
                  }

                  //SHA 알고리즘은 비밀번호를 암호화한다. SSH 와 비슷 검사할때는 다시 풀어줘야한다.
                  $query = "insert into membership values('$id', SHA('$password'))";
                  $result = mysqli_query($dbc, $query)
                     or die("회원가입 정보 insert 실패");
                  $query = "insert into profile values('$nickname', '$username', '$id', '$question', '$answer', '$img')";
                  $result = mysqli_query($dbc, $query)
                     or die("프로필 정보 insert 실패");




                    echo "<p><center>"."$username". "님의 회원가입을 축하드립니다.</center></p>";
                    mysqli_close($dbc);

                  ?>
                  <a href="index.php"><center>누르시면 첫화면으로 돌아갑니다.</center></a>
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
