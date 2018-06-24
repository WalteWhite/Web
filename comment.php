<?php
    require_once("session.php");
?>

<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once('mysql_config.php');

    $dbc = mysqli_connect($host, $user, $pass)
      or die("DB 연결 실패");
      mysqli_query($dbc,'set names utf8');
      mysqli_select_db($dbc,"gctravel");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <style media="screen">
      #commentbtn{
        -webkit-transition-duration: 0.4s; /* Safari */
        transition-duration: 0.4s;
        background-color: white;
        color: gray;
        border: 1px solid #FFFFFF;
      }
      #commentbtn:hover{
        background-color: #D4F4FA;
      }
    </style>

    <script type="text/javascript">

    function link(){

    }

    </script>
  </head>
  <body>

<?php
	$sql = 'select * from comment where co_num=co_order and b_num=' . $bNo;
	$result = $dbc->query($sql);
?>

<div id="commentView">
  <form action="comment_update.php" method="post">
		<input type="hidden" name="bno" value="<?php echo $bNo?>">

	<?php
		while($row = $result->fetch_assoc()) {
	?>

	<ul class="oneDepth">
    <div id="co_<?php echo $row['co_no']?>" class="commentSet">
      <div class="commentInfo">
        <div class="commentId"><span class="coId"><?php echo $row['co_id']?></span></div>
        </div>
        <div class="commentContent"><?php echo $row['co_content']?></div>
         <div class = "commentbtn">
            <button type="button" class="btn btn-primary btn-xs" id="commentbtn" onclick="modify();">수정</button>
            <button type="button" class="btn btn-primary btn-xs" id="commentbtn" onclick="delete();">삭제</button>
        </div>
      </div>

			<?php
				$sql2 = 'select * from comment where co_num!=co_order and co_order=' . $row['co_num'];
				$result2 = $dbc->query($sql2);

				while($row2 = $result2->fetch_assoc()) {
			?>
      <!-- 답글 기능 미구현 2017.7.10까지 목표....
			<ul class="twoDepth">
				<li>
          <div id="co_<?php //echo $row2['co_no']?>" class="commentSet">
            <div class="commentInfo">
              <div class="commentId"><span class="coId"><?php //echo $row2['co_id']?></span></div>
              </div>
              <div class="commentContent"><?php //echo $row2['co_content'] ?></div>
              <div class="commentBtn">
                <a href="#" class="comt modify">수정</a>
                <a href="#" class="comt delete">삭제</a>
              </div>
            </div>
				</li>
			</ul>
      -->
			<?php
				}
			?>

		</li>
	</ul>
	<?php } ?>
  </form>
</div>


<form action="comment_update.php" method="post">
	<input type="hidden" name="bno" value="<?php echo $bNo?>">
        <hr>
        <label for="bID">아이디</label>
        <?php

        if (!isset($_SESSION['id'])){
          echo "로그인을 해야 댓글을 쓸수 있습니다.";
        }
        else{
        $id = $_SESSION['id'];
        echo '<td>'.$id.'</td>';
        }
         ?>

      <div class="pwdiv">
			<label for="coPassword">비밀번호</label>
			<input type="password" name="coPassword" id="coPassword" class="form-control">
      </div>
      <div class="conetentdiv">
			<label for="coContent">내용</label>
			<td><textarea name="coContent" id="coContent" class="form-control"></textarea>
      </div>

  <?php
  if (!isset($_SESSION['id'])){

  }
  else {
	echo '<div class="btndiv">
		<center><input type="submit" class="btn btn-default btn-sm btn-block" value="댓글 작성"></center>
	</div>';
  }
  ?>
</form>



</body>
</html>
