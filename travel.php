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

    <title>GC Travel | Travel</title>

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
    background-color: #4374D9;
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

                  require_once('mysql_config.php');
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
    <header class="intro-header" style="background-image: url('img/post-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1>아주 평범한 월요일이다.</h1>
                        <h2 class="subheading">평범한 일상</h2>
                        <span class="meta">Posted by 지가인 on Sep 29, 2014</span>
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
                    <p>다시 월요일이다.
                      1. 오후에 일과를 마치고(그 일과는 2번에) 빨래를 했다. 주로 월요일에 빨래를 자주 하는데 오늘 따라 매일 똑같은 빨래를 하는 일상이지만 이 순간을 기록하고 싶었다.
                      빨래를 햇볕 잘 드는 베란다에 널어놓는데(농담 아니고 30분이면 티셔츠가 바싹 마른다) 우리 모텔 매니저 무세이 아저씨의 손자들인 잭스니, 조지가 또 꺄르르 웃으며 나에게 인사해준다.
                      잭슨 조지 너무 귀엽고 재밌고 신기한 아이들이다. 잭슨은 훈훈하게 매일 인사할 때마다 웃어주고,
                      조지는 처음에는 우리가 다가가기만 하면 질겁을 하면서 도망가고 울고 했는데(근데 또 멀리에서는 뭐라뭐라 손짓 발짓 몸짓 해가면서 우리를 향해 말은 또 한다)
                      이제는 도망가지는 않고 우리 앞에서는 초얼음이 되어서 파이니(fine) 파이니를 긴장하면서 외친다ㅎㅎㅎㅎㅎㅎㅎㅎㅎ상상만 해도 너무 웃기고 귀엽다. </p>
                      <a href="#">
                          <center><img class="img-responsive" src="img/tr01.jpg" alt="" width="500" height="500"></center>
                      </a>
                    <p>아무튼 내 방은 3층인데 여기 베란다에서는 우리 모텔 컴파운드(뒷마당 같은..)가 한눈에 내려다보인다.
                      레스토랑 직원 엄니들은 마토케를 까거나 쌀에서 돌을 고르고 있고,
                      잭슨과 조지는 나를 향해 웃으며 꺄르르 소리지르고,
                      그 좁은 닭장 안에서 닭들은 서로 싸우고 있고, 길 잃은 염소는 어쩌다 모텔안 뒷마당까지 들어와서 매애~ 울고있다. </p>
                      <a href="#">
                          <center><img class="img-responsive" src="img/tr02.jpg" alt="" width="500" height="500"></center>
                          <center><img class="img-responsive" src="img/tr03.jpg" alt="" width="500" height="500"></center>
                      </a>

                    <h2 class="section-heading">학교가는길</h2>
                    <p>오늘 학교에 갔더니 베티가 오랜만에 학교에 왔다. 내가 예뻐하는 베티, 리차드 남매. (애들이 너무 착하고 예쁜데 새엄마 밑에서 자라서 케어를 전혀 못받아서 엄청 더럽고 발에 지가스 걸리고 난리도 아니다..)
                    근데 글쎄 베티가 발이....발이..다친게 아닌가ㅠ.ㅠ 그래서 혜나랑 같이 베티랑 리차드 데리고 마소데 약국에 갔다. 약국에서 베티가 치료 받는동안 주혜나는 애들 먹일 물이랑 카사바 사러 가고 베티 발에 상처에 과산화수소랑 빨간약
                    발라주는데 그 어린 애기가 엄마 찾으면서 자지러지게 우는게 아닌가 ㅠㅠ. 그 어리고 예쁜애가.
                    내가 해줄 수 있는거라고는 안아주면서 무릎에 앉히면서 눈 가려주면서"다 끝나간다~ 아이구 이쁘다~ 잘했다 잘했어"라고 토닥여주는 일 밖에는 없었다.
                    그러게 소독과 약발라주기를 끝내고 상처에 먹는 약도 먹고 카사바랑 물도 먹이고 다시 학교로 돌아가려니 베티가 절뚝거리며 못 걷길래 업고왔다. 애 집을 물어보니 한시간은 걸어야 한단다.
                    그래서 수업이 끝나고 그 전부터 몇 번이나 베티네에 가고싶어 했었기에 마담에게 애들 엄마에게 약 복용법이 적힌 편지를 써달라 해서 그 편지랑 주혜나와 함께 보다에 리차드와 베티를 태우고 애들네 집에 갔다.
                    집 가는길은 오마이갓. 나는 여태 이 동네에 7개월 살면서 그렇게 마소데 안쪽에 완전 깊게 차도 못다니는 오프로드가 있을줄은 상상도 못했다. 그런 수풀길을(정말 in the middle of nowhere)
                    달려 마을도 아닌 외딴 데에 집에 도착해서 그 유명한 애들 새엄마를 봤다. 도대체 어떤 여자길래 애들을 이지경으로 만드나.. 하고 봤는데 너무 멀쩡하게 생기고 영어도 좀 해서 응? 싶었다.
                    그렇다고 내가 무슨 자격으로 애들 좀 케어하고 씻기고 해주세요! 할 수도 없고..
                    해서 편지만 얼른 주고 돌아오려는데 편지가 없어진거.......아 나 진짜....내가 분명 손에 잘 들고 있었는데.....ㅡㅡ..... 칠칠맞은 지가인이 요즘 잠잠하다 했는데 오랜만에 한 건 했다.
                    나는 애엄마랑 얘기하느라 집 안에 들여다보지 못했는데 나중에 주혜나 말로는 진짜 진짜 개쓰레기라고..또 그 안에 애아빠는 누워있다고 했다. 그리고 애들은 또 학교다녀오자마자 엄청 해진 옷으로 갈아입는다.
                    그 집에서 나와서 다시 오토바이로 학교로 돌아가는데 여러 생각이 들었다. 우선 편지 어따 흘리고 온 칠칠맞은 나한테도 좀 짜증이 나 있었지만 애들이 사는 저 환경이,
                    애들을 방치하는 저 부모님이, 또 그 애들한테 걸어서 왕복 2시간 거리 마을에 물을 떠오거나 심부름을 다녀오는 그런 아이들의 상황을 알고는 있었는데 막상 아이들을 사는 집을,
                    그리고 통학하는 그 길을 심지어 걷는것도 아니고 오토바이 타고 와보니 정말 열악하다는 것을 보게 되었다.
                    24살에는 세상에 이런 고통받는 사람들(그 때는 어린이라고 생각도 안했다)을 위해서 일하고 싶다고 생각했었는데,
                    그래서 그 첫 경험으로 코이카에서 인턴도 해보고(ㅋㅋㅋㅋㅋㅋㅋㅋㅋ) 그 때에도 회의를 느꼈지만 그래도 다시 한 번 제대로 아프리카를 보자 하는 마음으로 우간다에 왔지만
                    여전히 내가 이 사람들을 위해 일한다고 해도 바뀌는 것은 없다는 사실은 달라지지 않는다.
                    </p>
                    <a href="#">
                        <center><img class="img-responsive" src="img/tr05.jpg" alt="" width="500" height="500"></center>
                    </a>
                    <blockquote>항상 해맑은 아이들</blockquote>

                    <h2 class="section-heading">매일 다른 풍경이다</h2>

                    <p>오늘 아침에 학교에 자전거를 타고 가는데 매일 보던 풍경이 조금 달리 보였다. 그냥 저 나무가 안보였는데 오늘 처음 보였고, 저기에 저런 집이 있었던가 했는데 그런게 있었다.
                    7개월 달렸는데도 새롭게 느껴졌다. 그리고 그 때 한 생각은 이 생활이 참 소중하다는거, 감사하다는 거다.
                    내가 맨날 사소하게 이것저것에 감사하면 어떤 사람들은 그것들이 너에게 뭘 해줬길래 감사하냐? 라고 말할수도 있다. 사실 그렇게 말하면 음 직접적으로 뭘 해준거는 없지..
                    라고 말할수도 있겠지만 그냥 저 나무와 산을 봄으로써 내가 기분이 좋아지니까 감사하고, 저 아이들이 나를 보며 웃으니까 나도 마음이 평화로워져서 그게 참 고마운거고,
                    내 옆에 나와 함께있는 사람들이 이 사람들이라 다행인거다. 그런게 없어도 살긴 살겠지만 덜 기분이 좋을거 아냐. 그리고 내가 아 좋다~~ 라고 느낄수도 없을테고.
                    좋은 게 많으면 그만큼 싫은 것도 많은거다 라는 이야기를 들었다. 예를들어 '난 해가 짱짱한 맑은 날이 좋아~!' 라는 것은 곧 흐리고 우중충한 날은 싫어한다. 라는 이야기가 되니까.
                    근데 인생을 편하게 즐겁게 살려면 '해 뜨는 날은 해 뜨는 날 대로 신나고 업되고 맥주가 땡기네! 좋다' 라고 말하고 흐린 날에는 '흐린 날은 흐린 날대로 으슬으슬하니 분위기 있다.
                    따뜻한 라떼 마시면서 윤하 노래가 듣고 싶은 날이네. 좋~다' 라고 생각하는게 좋은것 같다. 또 내가 평생 생각하고 살아온 방식이고.
                    이렇게 생각하고 살면 마음은 엄청 느긋하고 긍정적이여지지만 이것도 좋고 저것도 좋으니까 주관이 흐리고 또 싫은게 없으니까 발전이 없다는 단점이 있다.
                    윽 해질녘에 베란다에서 일기썼더니 모기 물렸다. 이제 일기 그만쓰고 죽음의 30분 비디오 운동하고 씻고 보고서 써야겠다. 몇 번 말하지만 누가 치보가에서 한가하다 그랬어...
                    할 일 투성이로 하루가 꽉 찬다. 다 게으른 나를 같이 이끌어주는 부지런하고 좋은 동생들 덕이다. 마무리로 훈훈하게 주혜나 김수린 ㅅㄹ한.... 아니다 사랑은 모르겠고 그냥 좋아한다 내가 잘할게 허허허..........
                    </p>

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
