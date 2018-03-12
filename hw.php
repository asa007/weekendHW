

<?php
// ここにDBに登録する処理を記述する
if(!empty($_POST)){


$clubname=htmlspecialchars($_POST['clubname']);
$lylics=htmlspecialchars($_POST['lylics']);
$music=$_POST['music'];


 // １．データベースに接続する
  $dsn = 'mysql:dbname=online_bbs;host=localhost';
  $user = 'root';
  $password='';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->query('SET NAMES utf8');

  // ２．SQL文を実行する
  $sql = "INSERT INTO `chants` (`clubname`, `lylics`, `music`) VALUES (?, ?, ?);";

  //プリペアーステートメント
  $data=array($clubname,$lylics,$music);
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);

  // ３．データベースを切断する
  $dbh = null;


}


?>









<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Jリーグチャント集</title>

  <!-- CSS -->
  <link rel="stylesheet" href="oneline_bbs-master/assets/css/bootstrap.css">
  <link rel="stylesheet" href="oneline_bbs-master/assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="oneline_bbs-master/assets/css/form.css">
  <link rel="stylesheet" href="oneline_bbs-master/assets/css/timeline.css">
  <link rel="stylesheet" href="oneline_bbs-master/assets/css/main.css">
  <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
  </head>
<body>
  <!-- ナビゲーションバー -->
  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#page-top"><span class="strong-title"><i class="fas fa fa-futbol-o fa-spin animated"></i>  Jリーグチャント集   <i class="fas fa fa-futbol-o fa-spin animated"></i></span></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>

  <!-- Bootstrapのcontainer -->
  <div class="container">
    <!-- Bootstrapのrow -->
    <div class="row">

      <!-- 画面左側 -->
      <div class="col-md-3 content-margin-top">
        <!-- form部分 -->
        <form action="hw.php" method="post">
          <!-- clubname -->
          <div class="form-group">
            <div class="input-group">
              <input type="text" name="clubname" class="form-control" id="validate-text" placeholder="clubname" required>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
          </div>
          <!-- lylics -->
          <div class="form-group">
            <div class="input-group" data-validate="length" data-length="4">
              <textarea type="text" class="form-control" name="lylics" id="validate-length" placeholder="lylics" required></textarea>
              <span class="input-group-addon danger"> <span class="glyphicon glyphicon-remove"></span></span> 
            </div>
          </div>
          <!-- <!- music-->
          <div class="form-group">
            <div class="input-group" data-validate="length" data-length="4">
              <textarea type="text" class="form-control" name="music" id="validate-length" placeholder="music" required></textarea>
              <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
            </div>
          </div>
          <!-- 投稿ボタン -->
          <button type="submit" class="btn btn-primary col-xs-12" >投稿</button>
        </form>
      </div>

      <!-- 画面右側 -->
      <div class="col-md-9 content-margin-top">
        <div class="timeline-centered">
          <article class="timeline-entry">
              <div class="timeline-entry-inner">
                  <!-- <div class="timeline-icon bg-success">
                      <i class="entypo-feather"></i>
                      <i class="fa fa-music "></i>
                  </div> -->
                  <!-- <div class="timeline-label"> -->
                      <!-- <h2><a href="#">ガンバ大阪</a> <span></span></h2>
                      <p>俺たちが　大阪さ　青と黒　俺らだけ</p>
                      <iframe width="560" height="315" src="https://www.youtube.com/embed/HywAFR5IlvA?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> -->
                  <!-- </div> -->

<?php 

// １．データベースに接続する
$dsn = 'mysql:dbname=online_bbs;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

// ２．SQL文を実行する
$sql = 'SELECT * FROM `chants` ORDER BY `id` DESC';
$stmt = $dbh->prepare($sql);
$stmt->execute();

//データ取得
$survey_line = array();
while(1){
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  //取得できるデータが何もなくなったら処理を終了する
  if($rec==false){
    break;
  }

  $_clubname=$rec['clubname'];
  $_lylics=$rec['lylics'];
  $_music=$rec['music'];


  $survey_line=[];
  $survey_line = "<div class='timeline-icon bg-success'>
                      <i class='entypo-feather'></i>
                      <i class='fa fa-music ''></i>
                  </div>

                    <div class='timeline-label label-sita'>
                    <h2>
                      <a href='#'> $_clubname</a></h2>
                    <p>
                      $_lylics
                    </p>
                    <p>
                      <iframe width='560' height='315' src= $_music frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>
                    </p>
                  </div>";
    echo $survey_line;
    echo "<br>";

}


// $rec = $stmt->fetch(PDO::FETCH_ASSOC);
// $survey_line[]=$rec;
// // var_dump($rec);


// $rec = $stmt->fetch(PDO::FETCH_ASSOC);
// $survey_line[]=$rec;
// // var_dump($rec);

// ３．データベースを切断する
$dbh = null;

?>







              </div>
          </article>

         








 <article class="timeline-entry begin">
              <div class="timeline-entry-inner">
                  <div class="timeline-icon bg-success" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
                      <i class="entypo-flight"></i><i class="fas fa-angle-double-right"></i>
                  </div>
              </div>
          </article>
        </div>
      </div>

    </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <!--  Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/form.js"></script>

</body>
</html>




