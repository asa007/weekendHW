
 
<?php 
// ここにDBに登録する処理を記述する
$clubname=htmlspecialchars($_POST['clubname']);
$lylics=htmlspecialchars($_POST['lylics']);
// $music=htmlspecialchars($_POST['music']);

 // １．データベースに接続する
  $dsn = 'mysql:dbname=online_bbs;host=localhost';
  $user = 'root';
  $password='';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');

  // ２．SQL文を実行する
  $sql = "INSERT INTO `survey` (`clubname`, `lylics`, `music`) VALUES (?, ?, ?);";

  //プリペアーステートメント
  $data=array($clubname,$lylics,$music);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  // ３．データベースを切断する
  $dbh = null;
?>

<?php 
$nickname=$_POST['clubname'];
$email=$_POST['lylics'];
$content=$_POST['music'];
 ?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Jリーグチャント集</title>
</head>
<body>
    <form method="post" action="">
      <p><input type="text" name="clubname" placeholder="clubname"></p>
      <p><textarea type="text" name="lylics" placeholder="lylics"></textarea></p>
      <p><textarea type="text" name="music" placeholder="music"></textarea></p>
      <p><button type="submit" >投稿</button></p>
    </form>
    <!-- clubname、lylics、music -->
  <div>
    <h3><?php echo $clubname; ?></h3>
    <p><?php echo $lylics; ?></p>
    <p><?php echo $music; ?></p>
  </div>

</body>
</html>