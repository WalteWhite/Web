<?php
    require_once("session.php");
?>

<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once('mysql_config.php');
?>

<?php

$dbc = mysqli_connect($host, $user, $pass)
  or die("DB 연결 실패");
  mysqli_query($dbc,'set names utf8');
  mysqli_select_db($dbc,"gctravel");

  $w = '';
  $coNo = 'null';

  //덧글이 없기때문에 아직 작동안함..이렇게 하면되겠지 라고 짰지만
  //실제로 테스트를 어떻게 해야 될지 모르겠다..ㅠㅠㅠ
  if(isset($_POST['w'])) {
    $w = $_POST['w'];
    $coNo = $_POST['co_no'];
  }

	$bNo = $_POST['bno'];
	$coPassword = $_POST['coPassword'];

  if($w !== 'd') {//$w 변수가 d일 경우 $coContent와 $coId가 필요 없음.
  $coContent = $_POST['coContent'];
  if($w !== 'u') {//$w 변수가 u일 경우 $coId가 필요 없음.
    $co_id = $_SESSION['id'];
  }
}



  if(empty($w) || $w === 'w') { //$w 변수가 비어있거나 w인 경우

    $msg = '작성';
    $sql = 'insert into comment values(null, ' .$bNo . ', ' . $coNo . ', "' . $coContent . '", SHA("' . $coPassword . '"), "' . $co_id . '")';

    if(empty($w)) { //$w 변수가 비어있다면,

      $result = $dbc->query($sql);
      $coNo = $dbc->insert_id;
      $sql = 'update comment set co_order = co_num where co_num = ' . $coNo;

    }



  } else if($w === 'u') { //작성

    $msg = '수정';
    $sql = 'select count(*) as cnt from comment where co_password=SHA("' . $coPassword . '") and co_num = ' . $coNo;
    $result = $dbc->query($sql);
    $row = $result->fetch_assoc();

    if(empty($row['cnt'])) { //맞는 결과가 없을 경우 종료

  ?>

      <script>
        alert('비밀번호가 맞지 않습니다.');
        history.back();
      </script>

  <?php
      exit;
    }

    $sql = 'update comment set co_content = "' . $coContent . '" where co_password=SHA("' . $coPassword . '") and co_num = ' . $coNo;

  } else if($w === 'd') { //삭제
    $msg = '삭제';
    $sql = 'select count(*) as cnt from comment where co_password=SHA("' . $coPassword . '") and co_num = ' . $coNo;
    $result = $dbc->query($sql);
    $row = $result->fetch_assoc();
    if(empty($row['cnt'])) { //맞는 결과가 없을 경우 종료

  ?>

      <script>
        alert('비밀번호가 맞지 않습니다.');
        history.back();
      </script>

  <?php
      exit;
    }
    $sql = 'delete from comment where co_password=SHA("' . $coPassword . '") and co_num = ' . $coNo;
  } else {

  ?>

    <script>
      alert('정상적인 경로를 이용해주세요.');
      history.back();
    </script>

  <?php
    exit;
  }

  $result = $dbc->query($sql);
  if($result) {
  ?>

    <script>
      alert('댓글이 정상적으로 <?php echo $msg?>되었습니다.');
      location.replace("./view.php?bno=<?php echo $bNo?>");
    </script>

  <?php
  } else {
  ?>

    <script>
      alert('댓글 <?php echo $msg?>에 실패했습니다.');
      history.back();
    </script>

<?php
    exit;
  }
?>
