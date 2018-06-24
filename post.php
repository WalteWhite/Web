<?php
    require_once("session.php");
?>

<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

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

    .paging {text-align: center; margin: 30px 0 0 0;}
    .paging li {display: inline-block; height: 20px; margin: 0 5px; padding: 0 5px; border: 1px solid #EAEAEA; background: #FFFFFF; line-height: 21px;}

    .paging li.current,
    .paging li:hover {background: #FFFFFF;}
    .paging li.current,
    .paging li:hover a { color: #6799FF;}

    #searchbtn{
      -webkit-transition-duration: 0.4s; /* Safari */
      transition-duration: 0.4s;
      background-color: white;
      color: gray;
      border: 1px solid #EAEAEA;
    }
    #searchbtn:hover {
    background-color: #D9E5FF;
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
                        <a href="Travel.php">Travel</a>
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
                        <h1>자유게시판</h1>
                        <h2 class="subheading">회원들의 공간입니다.</h2>
                        <span class="meta">공지사항을 읽어주세요.</span>
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
                    <div class="table-responsive">
                    <table class="table table-bordered">
                    <caption class="readHide"><center>자유 게시판<hr></center></caption>
                      <thead>
                        <tr class="boardtr">
                          <th scope="col" class="num" id="b_th">번호</th>
                          <th scope="col" class="title" id="b_th">제목</th>
                          <th scope="col" class="author" id="b_th">아이디</th>
                          <th scope="col" class="date" id="b_th">작성일</th>
                          <th scope="col" class="hit" id="b_th">조회수</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php

                        require_once('mysql_config.php');
                        $dbc = mysqli_connect($host, $user, $pass)
                          or die("DB 연결 실패");
                          mysqli_query($dbc,'set names utf8');
                          mysqli_select_db($dbc,"gctravel");

                        /* 페이징 시작 */
                        //페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
                        if(isset($_GET['page'])) {
                          $page = $_GET['page'];
                        } else {
                          $page = 1;
                        }

                        /* 검색 시작 */

                        $subString = null;
                        $searchColumn = null;

                        if(isset($_GET['searchColumn'])) {
                          $searchColumn = $_GET['searchColumn'];
                          $subString .= '&amp;searchColumn=' . $searchColumn;
                        }
                        if(isset($_GET['searchText'])) {
                          $searchText = $_GET['searchText'];
                          $subString .= '&amp;searchText=' . $searchText;
                        }

                        if(isset($searchColumn) && isset($searchText)) {
                          $searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
                        } else {
                          $searchSql = '';
                        }
                        /* 검색 끝 */

                        $sql = 'select count(*) as cnt from board' . $searchSql;
                        $result = $dbc->query($sql);
                        $row = $result->fetch_assoc();

                        $allPost = $row['cnt']; //전체 게시글의 수

                        if(empty($allPost)) {
                          $emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';
                          //검색란을 추가해서 페이지가 $paging 오류가 발생한다.
                          $paging = '<ul>';
                          $paging .= '<li class="page current">1</li>';
                          $paging .= '</ul>';

                        } else {

                        $onePage = 15; // 한 페이지에 보여줄 게시글의 수.
                        $allPage = ceil($allPost / $onePage); //전체 페이지의 수

                        if($page < 1 || $page > $allPage) {
                        ?>
                          <script>
                            alert("존재하지 않는 페이지입니다.");
                            history.back();
                          </script>

                        <?php
                          exit;
                        }

                        $oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
                        $currentSection = ceil($page / $oneSection); //현재 섹션
                        $allSection = ceil($allPage / $oneSection); //전체 섹션의 수

                        $firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

                        if($currentSection == $allSection) {
                          $lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
                        } else {
                          $lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
                        }

                        $prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
                        $nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

                        $paging = '<ul>'; // 페이징을 저장할 변수

                        //첫 페이지가 아니라면 처음 버튼을 생성
                        if($page != 1) {
                          $paging .= '<li class="page page_start"><a href="post.php?page=1' . $subString . '">처음</a></li>';
                        }

                        //첫 섹션이 아니라면 이전 버튼을 생성
                        if($currentSection != 1) {
                          $paging .= '<li class="page page_prev"><a href="post.php?page=' . $prevPage . $subString . '">Previously</a></li>';
                        }

                        for($i = $firstPage; $i <= $lastPage; $i++) {
                          if($i == $page) {
                            $paging .= '<li class="page current">' . $i . '</li>';
                          } else {
                            $paging .= '<li class="page"><a href="post.php?page=' . $i . $subString . '">' . $i . '</a></li>';
                          }
                        }


                        //마지막 섹션이 아니라면 다음 버튼을 생성
                        if($currentSection != $allSection) {
                          $paging .= '<li class="page page_next"><a href="post.php?page=' . $nextPage . $subString . '">다음</a></li>';
                        }

                        //마지막 페이지가 아니라면 끝 버튼을 생성
                        if($page != $allPage) {
                          $paging .= '<li class="page page_end"><a href="post.php?page=' . $allPage . $subString . '">끝</a></li>';
                        }

                        $paging .= '</ul>';

                        /* 페이징 끝 */
                        $currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
                        $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문
                        $sql = 'select * from board' . $searchSql . ' order by b_num desc' . $sqlLimit;  //원하는 개수만큼 가져온다. (0번째부터 20번째까지
                        $result = $dbc->query($sql);
                        }
                        ?>

                        <?php

                        $dbc = mysqli_connect($host, $user, $pass)
                          or die("DB 연결 실패");
                        mysqli_query($dbc,'set names utf8');
                        mysqli_select_db($dbc,"gctravel");

                        if(isset($emptyData)) {
                          echo $emptyData;
                        } else {

                        while($row = $result->fetch_assoc())
                        {
                          $datetime = explode(' ', $row['b_date']);
                          $date = $datetime[0];
                          $time = $datetime[1];
                          if($date == Date('Y-m-d'))
                          $row['b_date'] = $time;
                          else
                          $row['b_date'] = $date;

                         ?>

                         <tr>
					                  <td class="no" id="b_td"><?php echo $row['b_num']?></td>
					                  <td class="title" id="b_td">
                              <a href="./view.php?bno=<?php echo $row['b_num']?>"><?php echo $row['b_title']?>
                            </a></td>
					                  <td class="author" id="b_td"><?php echo $row['id']; if(empty($row['id'])){echo "탈퇴회원";}?></td>
                  					<td class="date" id="b_td"><?php echo $row['b_date']?></td>
                  					<td class="hit" id="b_td"><?php echo $row['b_hit']?></td>
                				</tr>

                					<?php
                						}
                          }
                					?>

                      </tbody>
                    </table>
                  </div>
                  </article>

                  <script type="text/javascript">
                  function link(){
                    location.href = "write.php";
                  }
                  </script>
                  <center><input type="button" name="btn" value="글쓰기" id="btn" onclick="link(); return false;"></center>
                  <div class="paging">
                    <?php echo $paging ?>
                  </div>

                  <div class="searchbox">
				           <form action="post.php" method="get">
                     <div class="col-xs-3">
					           <select name="searchColumn" class="form-control">
                       <center>
						           <option <?php echo $searchColumn=='b_title'?'selected="selected"':null?> value="b_title">제목</option>
						           <option <?php echo $searchColumn=='b_content'?'selected="selected"':null?> value="b_content">내용</option>
						           <option <?php echo $searchColumn=='id'?'selected="selected"':null?> value="id">아이디</option>
                       </center>
					           </select>
                    </div>
                   <div class="col-xs-6">
					         <input type="text" name="searchText" class="form-control" value="<?php echo isset($searchText)?$searchText:null?>">
                   </div>
                   <button type="submit" id="searchbtn" class="btn btn-primary btn-md"><center>검색</center></button>
				           </form>

			            </div>
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
