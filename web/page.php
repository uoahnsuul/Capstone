<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TAKE | TAKE 소개</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Temporary navbar container fix -->
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


<?php include('includes/header.php');?>
<div id="cont">
<br>



  <!-- Call to Action Section -->
  <br><br>
<!--
  <div   align="center" style="color:#8f9435;
    font-family: 조선일보명조; font-size: 25px">뉴스 유사도 분석, TAKE</div>
  <hr>
  <div class="row mb-4">
      <div align="center" class="col-md-12">
        <div class="info-text">
            <i class="fas fa-check-circle"></i>
            <br>
            - 테이크(TAKE)는 다양한 언론사로부터 수집한 뉴스를 머신러닝 기반의 기술로 분석하는 서비스입니다.
            <br>
          - 테이크(TAKE)는 누구나 무료로 이용할 수 있는  서비스이며 원하는 기사의 주요 키워드, 요약문 등을 열람하실 수 있습니다.
        </div>

      </div>
      <div align="center" class="col-md-12">
<br>


<br><br><hr>

      </div>

  </div>
-->
    <!-- Page Content -->
    <div class="container">



              <div class="row">
                  <div class="col-md-12">
                      <div class="info-text">
                        <h4 class="card-title">
                            뉴스 유사도 분석, TAKE
                        </h4>
                        <hr>
                        <i class="fas fa-check-circle"></i>
<br>
                        - 테이크(TAKE)는 다양한 언론사로부터 수집한 뉴스를 머신러닝 기반의 기술로 분석하는 서비스입니다.
                        <br>
                      - 테이크(TAKE)는 누구나 무료로 이용할 수 있는  서비스이며 원하는 기사의 주요 키워드, 요약문 등을 열람하실 수 있습니다.
                      <br>
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="info-card middle">
                          <h4 class="card-title">
                            <br><br><br><br>
                              핵심 경쟁력
                              <hr>
                          </h4>

                          <div class="card-content">
                                <img src="images/intro.png" class="w-100">
                          </div>
                      </div>
                  </div>

                  <div class="col-md-12">
                      <div class="info-card middle">
                          <h4 class="card-title">
                            <br><br><br><br>
                            서비스 개념도
                              <hr>
                          </h4>

                          <div class="card-content">
                            <br>
                                <img src="images/sssss.png" class="w-100">
                                <br><br><br>
                                <div align="center" class="col-md-12">
                                  ▶ 매체에서 제공하는 기사들을 주기적으로 수집하여 분석 DB에 저장한 후,
                                  사용자 입력 기사와 유사도 검사를 수행합니다.
<br><br><br>
                                </div>
                                <br><br><br><br><br>
                          </div>
                      </div>
                  </div>




    <!-- /.container -->

</div>
    <!-- Footer -->


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
