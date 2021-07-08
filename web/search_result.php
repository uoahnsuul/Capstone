<?php

session_start();

	$db = new mysqli("localhost","root","autoset","capstone");
	$db->set_charset("utf8");

$keyword=$_GET['var'];

function mq($sql){
  global $db;
  return $db->query($sql);
}



?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TAKE | 오늘의 키워드</title>
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
          text-align: center;


        }
        h1{
          color:#8f9435;
          font-family: 조선일보명조;
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
div#word
{
  display : inline-block;
  width : 700px;
  height : 400px;
  word-break:normal;
  font-weight : bolder;
}
    </style>

<style type="text/css">
.cloud01 {
  color: red;
  font-size:10pt;
}
.cloud02 {
  color : black;
  font-size:10pt;
}
.cloud03 {
  color : black;
  font-size:5pt;
}
</style>

</head>

<body style="background-color:#f7f7f7">
	<?php include('includes/header.php');?>
	<div id="cont">
	<!-- Page Content -->
	<div class="container">

<br>
<h1 class="mt-4 mb-3" align="center"> '<?=$keyword?>' 키워드를 포함하고 있는 기사입니다.</small></h1>
<br>

<table class="table table-striped" style="text-align; center; border:1px solid #ddddda">

  <tr>
    <th width="10" style="background-color: #eeeeee; text-align: center;"> 매체 </th>
    <th width="300" style="background-color: #eeeeee; text-align: center;"> 제목 </th>
    <th width="100" style="background-color: #eeeeee; text-align: center;"> 작성일자 </th>
    <th width="100"style="background-color: #eeeeee; text-align: center;"> URL </th>

  </tr>

  <?php

  $sql2=mq("SELECT * FROM rawdata WHERE mainText like '%$keyword%' ORDER BY ID DESC");

  while($board = $sql2->fetch_array()){
    $title =$board["title"];
    if(strlen($title)>30){
      $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
      }
   ?>

   <tbody>
        <tr>
          <td width="10" style="background-color: #ffffff; text-align: center;"><?php echo $board['media']?></td>
          <td width="300" style="background-color: #ffffff; text-align: center;"><?php echo $board['title']?></td>
          <td width="100" style="background-color: #ffffff; text-align: center;"><?php
					if($board['media']=='Newsdaily' || $board['media']=='중앙일보'){
						preg_match_all("/[0-9]{4}\.[0-9]{1,4}\.[0-9]{1,2}/", $board['update_date'], $r);
						echo $r[0][0];
					}
					else{
						preg_match_all("/[0-9]{4}\-[0-9]{1,4}\-[0-9]{1,2}/", $board['update_date'], $r);
												echo $r[0][0];

					}
					?>
			</td>
        <td  width="100"  style="background-color:#ffffff; text-align: center;"> <?php echo "<a href='".$board['link']."'> 원문이동 </a>"; ?></td>
        </tr>
      </tbody>
<?php } ?>


</div>
</div>
		<!-- Bootstrap core JavaScript -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/tether/tether.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>
