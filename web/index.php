<?php
$host = 'localhost';
$dbname = 'capstone';
$username = 'root';
$rootpw = 'autoset';

$pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $rootpw);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>기사 분석 서비스</title>
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="css/modern-business.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <style>
    .navbar-toggler {
        z-index: 1;
    }

    @media (max-width: 576px) {
        nav > .container {
            width: 100%;
        }
    }
    .carousel-item.active,
    .carousel-item-next,
    .carousel-item-prev {
        display: block;
    }

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
        h4{
          color:#514938;
          font-family: 조선일보명조;
        }
        h2{
          color:#514938;
          font-family: 조선일보명조;
        }
        h3{
          color:#514938;
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


<body>

    <!-- Navigation -->
<?php include('includes/header.php');?>
<?php include('includes/slider.php');?>

    <!-- Page Content -->

      <div id="cont">
<br><br><br><br><br><br><br>



        <!-- Call to Action Section -->
        <br><br>
        <h1 align="center">유사도 비교, 왜 필요할까요?</h1>
        <hr>
        <div class="row mb-4">
            <div align="center" class="col-md-12">

                <p >
                  <li>방대한 정보들 속에서 동일한 ‘이슈’의 기사들을 분석, 비교해주는 서비스는 필수적입니다.</li>
                  <li>원하는 정보만 골라서 보고, 효율적으로 정보를 분류하실 수 있습니다. </li>
                  <li>TAKE에서 제공하는 분석결과를 자율적으로 평가하고 수용하실 수 있습니다.</li>
                </p>
            </div>
            <div align="center" class="col-md-12">
<br>
                    <button type="button" class="btn btn-danger" onclick="location.href='search.php'"> 유사도 분석하기 </button>

<br><br><hr>
                <!--class="btn btn-lg btn-secondary btn-block"-->
            </div>

        </div>
      <!-- Page Content -->
      <div align="center" class="container">
  <br><br><br><br>
          <!-- Page Heading/Breadcrumbs -->
          <h1 align="center" class="mt-4 mb-3">오늘의 키워드</small></h1>
          <ul style=" list-style:none;
           padding-left:0px;
           font-family: 조선일보명조;
           font-size: 12px;" align="right" class="col-md-9">
        <li style="color:#808080" > 분석기준: 2020.11.27 00:00 ~ 12:00 </li>
        </ul>
<hr>
<div align="right" class="col-md-12">

    <p >

      <img src="images/zz.png">

    </p>
</div>
<br><br>

  <div align="center" id="word">
    <?php

    // $query= 'select keyword, appear_num, category from today_keyword ORDER BY appear_num DESC LIMIT 23';
     $query= 'select keyword, appear_num, category from today_keyword where appear_num<10 and appear_num>7';
    $result = $pdo->query($query);

    foreach($result as $value){
      $count = $value['appear_num'];
      $category = $value['category'];
      $keyword = $value['keyword'];

      if($category == 0)
      {
        if($count >= 20)
        {
          echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:30%;'>
          <a style='color:#8f9435; font-size:40px' href ='search_result.php?var=$keyword'> $keyword </a>
        </div>";

        }
        else if($count > 10)
        {
          echo "<div style=' width: 300px; height:  40px; cursor: pointer; float:left ; width:33%;'>
          <a style='color:#8f9435; font-size:25px' href ='search_result.php?var=$keyword'> $keyword </a>
        </div>";

        }
        else
        {


          echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:26%;'>
          <a style='color:#8f9435; font-size:17px' href ='search_result.php?var=$keyword'> $keyword </a>
        </div>";
        }
      }
      else if($category == 1)
      {
        if($count >= 20)
        {
          echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:25%;'>
          <a style='color:#9d4926; font-size:40px' href ='search_result.php?var=$keyword'> $keyword </a>
        </div>";
        }
        else if($count > 10)
        {
          echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:33%;'>
          <a style='color:#9d4926; font-size:25px' href ='search_result.php?var=$keyword'> $keyword </a>
        </div>";
        }
        else
        {
          echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:21%;'>
          <a style='color:#9d4926; font-size:17px' href ='search_result.php?var=$keyword'> $keyword </a>
        </div>";
        }
      }
      else
      {
        if($count >= 20)
        {
          echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:25%;'>
          <a style='color:#514956; font-size:40px' href ='search_result.php?var=$keyword'> $keyword </a>
        </div>";
        }
        else if($count > 10)
        {
          echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:35%;'>
          <a style='color:#514956; font-size:25px' href ='search_result.php?var=$keyword'> $keyword </a>
        </div>";
        }
        else
        {
          echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:20%;'>
          <a style='color:#514956; font-size:17px' href ='search_result.php?var=$keyword'> $keyword </a>
        </div>";
        }
      }


    }
    $query= 'select keyword, appear_num, category from today_keyword where appear_num>10';
    $result = $pdo->query($query);

    foreach($result as $value){
     $count = $value['appear_num'];
     $category = $value['category'];
     $keyword = $value['keyword'];

     if($category == 0)
     {
       if($count >= 20)
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:25%;'>
         <a style='color:#8f9435; font-size:45px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";

       }
       else if($count > 10)
       {
         echo "<div style=' width: 300px; height:  40px; cursor: pointer; float:left ; width:20%;'>
         <a style='color:#8f9435; font-size:25px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";

       }
       else
       {


         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:25%;'>
         <a style='color:#8f9435; font-size:17px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
     }
     else if($category == 1)
     {
       if($count >= 20)
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:20%;'>
         <a style='color:#9d4926; font-size:40px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
       else if($count > 10)
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:25%;'>
         <a style='color:#9d4926; font-size:25px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
       else
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:21%;'>
         <a style='color:#9d4926; font-size:17px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
     }
     else
     {
       if($count >= 20)
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:30%;'>
         <a style='color:#514956; font-size:40px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
       else if($count > 10)
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:31%;'>
         <a style='color:#514956; font-size:25px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
       else
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:20%;'>
         <a style='color:#514956; font-size:17px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
     }
    }
    //echo "분석기준: 2020.11.27 00:00 ~ 12:00";
    $query= 'select keyword, appear_num, category from today_keyword where appear_num<7 and appear_num>4';
    $result = $pdo->query($query);

    foreach($result as $value){
     $count = $value['appear_num'];
     $category = $value['category'];
     $keyword = $value['keyword'];

     if($category == 0)
     {
       if($count >= 20)
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:30%;'>
         <a style='color:#8f9435; font-size:40px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";

       }
       else if($count > 10)
       {
         echo "<div style=' width: 300px; height:  40px; cursor: pointer; float:left ; width:33%;'>
         <a style='color:#8f9435; font-size:25px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";

       }
       else
       {


         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:20%;'>
         <a style='color:#8f9435; font-size:17px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
     }
     else if($category == 1)
     {
       if($count >= 20)
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:25%;'>
         <a style='color:#9d4926; font-size:40px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
       else if($count > 10)
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:33%;'>
         <a style='color:#9d4926; font-size:25px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
       else
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:21%;'>
         <a style='color:#9d4926; font-size:17px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
     }
     else
     {
       if($count >= 20)
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:25%;'>
         <a style='color:#514956; font-size:40px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
       else if($count > 10)
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:25%;'>
         <a style='color:#514956; font-size:25px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
       else
       {
         echo "<div style=' width: 300px; height: 50px cursor: pointer; float:left ; width:26%;'>
         <a style='color:#514956; font-size:17px' href ='search_result.php?var=$keyword'> $keyword </a>
       </div>";
       }
     }
    }
     ?>

  </div>

  <br>
          <!-- /.row -->



  </div>
  </div>
        <!-- Marketing Icons Section -->


        <!-- /.row -->


<br><br>

        <h1 align="center">분석 대상 매체</h1>
<hr><br>
        <div class="row mt-3" >
            <div class="col-lg-2">
            </div>
            <div class="col-lg-3">
                <a href="https://joongang.joins.com/"><img src="images/join.png"></a>
            </div>
            <div class="col-lg-3">
                <a href="https://www.donga.com/"><img src="images/donga.png"></a>
            </div>
            <div class="col-lg-3">
                <a href="http://www.hani.co.kr/"><img src="images/hani.png"></a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-3 mt-3">
                <a href="https://newsis.com/"><img src="images/newsis.png"></a>
            </div>
            <div class="col-lg-3">
                <a href="https://www.newsdaily.kr/"><img src="images/newsdaily.png"></a>
            </div>
            <div class="col-lg-3">
            </div>
        </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
  <?php include('includes/footer.php');?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
