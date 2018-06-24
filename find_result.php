
<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once('mysql_config.php');

    //$_GET['bno']이 있을 때만 $bno 선언

  ?>


<?php
  $dbc = mysqli_connect($host, $user, $pass)
    or die("DB 연결 실패");
    mysqli_query($dbc,'set names utf8');
    mysqli_select_db($dbc,"gctravel");

    $myanswer = mysqli_real_escape_string($dbc, trim($_POST['myanswer']));

    $sql = "select p_id,answer from profile where answer ='$myanswer'";
    $result = mysqli_query($dbc, $sql)
     or die("이름 불러오기 실패");
    $row = $result->fetch_assoc();

    $pid = $row['p_id'];
    $t_answer = $row['answer'];

    if($myanswer == $t_answer){
      $findmsg = $row['p_id'];
 ?>

 <script type="text/javascript">
  alert("<?php echo "아이디는".$findmsg."입니다. 홈으로 돌아갑니다."?>");
  location.href = "index.php";
 </script>

 <?php
  }else{
    $notmsg = "답변이 일치하지 않습니다.";
  ?>
  <script type="text/javascript">
   alert("<?php echo $notmsg?>");
   location.href = "find_id.php";
  </script>

  <?php
    exit; }
   ?>
