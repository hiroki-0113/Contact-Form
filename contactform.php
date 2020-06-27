<?php
session_start();
$mode='input';
if(isset($_POST['back']) && $_POST['back']){

}elseif(isset($_POST['confirm']) && $_POST['confirm']){
  $_SESSION['name'] = $_POST['name'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['message'] = $_POST['message'];

  $mode = 'confirm';
}elseif(isset($_POST['send']) && $_POST['send']){
  $message  = "お問い合わせを受け付けました \r\n"
              . "名前: " . $_SESSION['name'] . "\r\n"
              . "email: " . $_SESSION['email'] . "\r\n"
              . "お問い合わせ内容:\r\n";
  mail($_SESSION['email'],'お問い合わせありがとうございます',$message);
  mail('address','お問い合わせありがとうございます',$message);

  $_SESSION=array();
  $mode = 'send';
}else{
  $_SESSION =array();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>お問い合わせフォーム</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <style>
  body{
      padding: 10px;
      max-width: 600px;
      margin: 0px auto;
      color:#DDDDDD;
      background-color:#444444;
      font-size:20px;
    }
    div.button{
      text-align: center;
    }
    h1{
      margin-top:30px;
      margin-bottom:20px;
    }
    .form{
      margin-top:60px;
      margin-bottom:100px;
    }
    .backsend{
      margin-top:40px;
    }
  </style>
</head>
<body>
<h1>お問い合わせフォーム</h1>
    <div class="containr">
  <?php if( $mode == 'input' ){ ?>
    <form action="./contactform.php" method="post">
      名前    <input type="text"    name="name" value="<?php echo $_SESSION['name'] ?>" class="form-control"><br>
      Eメール <input type="email"   name="email" value="<?php echo $_SESSION['email'] ?>"class="form-control"><br>
      お問い合わせ内容<br>
      <textarea cols="40" rows="8" name="message"class="form-control"><?php echo $_SESSION['message'] ?></textarea><br>
      <input type="submit" name="confirm" value="確認" class="btn btn-primary"/>
    </form>
  <?php } else if( $mode == 'confirm' ){ ?>
    <form action="./contactform.php" method="post" class="form">
      名前：   <?php echo $_SESSION['name'] ?><br>
      Eメール： <?php echo $_SESSION['email'] ?><br>
      お問い合わせ内容：<br>
      <?php echo nl2br($_SESSION['message']) ?><br>
      <div class="backsend">
      <input type="submit" name="back" value="戻る" class="btn btn-primary"/>
      <input type="submit" name="send" value="送信" class="btn btn-primary"/>
      </div>
    </form>
  <?php } else { ?>
  送信しました。
  <?php } ?>
  </div>
</body>
</html>


