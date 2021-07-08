<?php
#사용자가 입력할 시, 사용자 input db에 저장
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','autoset');
define('DB_NAME','capstone');
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}


if(isset($_POST['submit']))
  {
    $keyword=$_POST['keyword'];



       if (empty($_POST['keyword'])) {
          echo "<script>
          alert(\"검색어를 입력해주세요.\");
            history.back();
          </script>";
        }
    else{
      $sql = "INSERT INTO userinput (maintext, flag) VALUES ('$keyword', '1')";


$query = $dbh->prepare($sql);
$query->bindParam(':keyword',$keyword,PDO::PARAM_STR);
$query->bindParam(':url',$url,PDO::PARAM_STR);
$query->bindParam(':maintext',$maintext,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();

exec('C:\AutoSet10\public_html\input.bat');


}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> TAKE & TEST | 사용자 기사입력</title>
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">
    <style>
    .navbar-toggler {
        z-index: 1;
    }

    @media (max-width: 576px) {
        nav > .container {
            width: 100%;
        }
    }
    </style>
    <style>
    div#cont{
      border : 10px solid #585d37;
      margin-top : 50px;
      background-color:#fff;
    }
    div#top{
      margin-bottom: 5px;
    }
    div#middle{
      margin-top: 5px;
      margin-bottom: 5px;
    }
    div#bottom{
      margin-top: 20px;
    }
    h1{
      color:#8f9435;
      font-family: 조선일보명조;
    }
    h2{
      color:#585d37;
      font-family: 조선일보명조;
      font-size: 15px;
    }
    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
    .succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
    </style>


</head>

<body style="background-color:#f7f7f7">

<?php include('includes/header.php');?>
    <div id="cont">
    <!-- Page Content -->
    <div class="container">
<br>
        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3" align="center">사용자 기사입력</small></h1>

<br>


<div class="row">

<div class="col-lg-6 mb-8">

<div class="mx-auto" style="width: 750px;">
    <img src="images/logo_ver.png" alt="">
</div>
</div>


<div class="col-lg-5 mb-10 mt-5">
  <form  method="post">
  <!--<form action="insertdb.php" method="post"> -->

<div id="top" class="font-italic">키워드</div>
<div><input type="text" name="keyword"  class="form-control" style="width:440px;height:100px;"  placeholder="#코로나19 / #확진자 / #코스피 / #환율 / ∙∙∙" autocomplete="off"></div>


<div id="bottom"><input type="submit" name="submit" class="btn btn-outline-success btn-block" value="submit" style="cursor:pointer" ></div>
<!--  <button type="button"  class="btn btn-block btn-success" onclick="location.href='media_report.php'"> 결과보기 </button>-->
</div>


</div>

         <a style="color:white" href="media_keyword.php"> 결과보기 </a>
</form>

</div>
</div>
<br><br>
        <!-- /.row -->
</div>
</div>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
