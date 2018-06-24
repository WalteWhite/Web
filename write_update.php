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

    <title>CG Travel | Write</title>

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
    .loginbox_div{
      margin: 50px 0 0 0;
    }
    .login_id_div{
      margin: 50px 0 0 0;
    }
    .login_pass_div{
      margin: 20px 0 0 0;
    }
    #submit {
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    background-color: white;
    width: 270px;
    height: 50px;
    }
    #submit:hover {
    background-color: #4CAF50; /* Green */
    color: white;
    }
    .submit_div{
      margin: 20px 0 0 0;
    }
    .find_div > a:hover,
    .find_div > a:focus {
      text-decoration: none;
      color: #0085A1;
    }

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

    <div class="container">
        <div class="row">
              <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

                <?php

                $dbc = mysqli_connect($host, $user, $pass)
                  or die("DB 연결 실패");
                  mysqli_query($dbc,'set names utf8');
                  mysqli_select_db($dbc,"gctravel");

                  if(isset($_POST['bno'])) {
                  $bNo = $_POST['bno'];
                  }

                  if(empty($bNo)) {
                  $date = date('Y-m-d H:i:s');
                  }

                	$bPassword = $_POST['bPassword'];
                	$bTitle = $_POST['bTitle'];
                	$bContent = $_POST['bContent'];

                  //글 수정

                  if(isset($bNo)) {
                  	//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
                  	$sql = 'select count(b_password) as cnt from board where b_password=SHA("' . $bPassword . '") and b_num = ' . $bNo;
                  	$result = $dbc->query($sql);
                  	$row = $result->fetch_assoc();

                  	//비밀번호가 맞다면 업데이트 쿼리 작성
                  	if($row['cnt']) {
                  		$sql = 'update board set b_title="' . $bTitle . '", b_content="' . $bContent . '" where b_num = ' . $bNo;
                  		$msgState = '수정';

                    //틀리다면 메시지 출력 후 이전화면으로
                  	} else {
                  		$msg = '게시글 비밀번호가 맞지 않습니다.';
                  	?>
                  		<script>
                  			alert("<?php echo $msg?>");
                  			history.back();
                  		</script>

                  	<?php
                  		exit;
                  	}

                  //글 등록
                  } else {

                	$sql = 'insert into board (b_num, b_title, b_content, b_date, b_hit, id, b_password)
                  values(null, "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, "' . $id . '", SHA("' . $bPassword . '"))';

                  $msgState = '등록';
                  }

                  //메시지가 없다면 (오류가 없다면)
                  if(empty($msg)) {

                	$result = $dbc->query($sql);

                	if($result) { // query가 정상실행 되었다면,
                    $msg = '정상적으로 글이 ' . $msgState . '되었습니다.';
                		if(empty($bNo)) {
                			$bNo = $dbc->insert_id;
                		}
                		$replaceURL = './view.php?bno=' . $bNo;
                	} else {
                		$msg = '글을 ' . $msgState . '하지 못했습니다.';

                ?>

                		<script>
                			alert("<?php echo $msg?>");
                			history.back();
                		</script>

                <?php
                    exit;
                	}
                }
                ?>

                <script>
                	alert("<?php echo $msg?>");
                	location.replace("<?php echo $replaceURL?>");
                </script>
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
