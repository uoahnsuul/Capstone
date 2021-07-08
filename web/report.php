<?php
$host = 'localhost';
$dbname = 'capstone';
$username = 'root';
$rootpw = 'autoset';

$pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $rootpw);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
$medianame=$_GET['var2'];
$document_id=$_GET['var3'];
$title=$_GET['var'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TAKE | Report</title>
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
    div#cont{
      border : 10px solid #585d37;
      margin-top : 50px;
      background-color:#fff;
    }
    div#key{
      margin-right : 10px;
      background-color:#585d37;
      color : #fff;
      border-radius: 3% ;
    }
    div#word{
      border : 3px solid #585d37;
      margin-top : 10px;
      margin-right : 10px;
      background-color:#fff;
    }
    div#text{
      border : 3px solid #585d37;
      background-color:#fff;
    }
    h1{
      color:#8f9435;
      font-family: 조선일보명조;
    }
    </style>

</head>

<body style="background-color:#f7f7f7">


<?php include('includes/header.php');?>
    <!-- Page Content -->
    <div id="cont">
    <div class="container">
<br>
      <h1 class="mt-4 mb-3" align="center">결과 분석</small></h1>
<br>


      <div class="row" align="center">
        <div class="col-lg-1 mt-4" style="font-size : 30px">
          <div>
            <?php
            $query2= "SELECT * FROM output ORDER BY id DESC LIMIT 1" ;
                  $result2 = $pdo->query($query2);
                  foreach($result2 as $value){
                    if($value['id1']== $document_id){

                    echo '<td>'.$value['max1'].  '</td>';
                    echo "%";}
                    else if($value['id2']== $document_id){

                    echo '<td>'.$value['max2'].  '</td>';
                    echo "%";}
                    else if($value['id3']== $document_id){

                    echo '<td>'.$value['max3'].  '</td>';
                    echo "%";}
                    else if($value['id4']== $document_id){

                    echo '<td>'.$value['max4'].  '</td>';
                    echo "%";}
                    else if($value['id5']== $document_id){

                    echo '<td>'.$value['max5'].  '</td>';
                    echo "%";}
                  }
                    ?>

          </div>
        </div>
        <div class="col-lg-10 mt-4" style="font-size : 30px">
          <div> <?=$medianame?> | <?=$title?>

          </div>
        </div>
      </div>

      <div class="row">
      <div class="col-lg-4 mb-8">
        <br><br><br>
        <div id="key" align ="center">KEYWORD</div>

        <div id="word" align ="center">
          <?php

          $query2= "SELECT * FROM keyvec WHERE document_ID= $document_id ORDER BY weight DESC LIMIT 3" ;
                $result2 = $pdo->query($query2);
                foreach($result2 as $value){
                  echo "#";
                  echo '<td>'.$value['keyword']. '<br>';
                  '</td>';
                }
                  ?>
        </div>
      </div>
      <div class="col-lg-8 mb-8">
        <br><br><br>
        <div class="mt-10">기사 요약문</div>
        <div id="text" align ="center">
          <?php

          $query2= "SELECT * FROM rawdata WHERE ID= $document_id" ;
                $result2 = $pdo->query($query2);
                foreach($result2 as $value){
                  echo '<td>'.$value['summary']. '</td>';

                }
                  ?>

        </div>
        <div align="right">
          <?php

          $query2= "SELECT * FROM rawdata WHERE ID= $document_id" ;
                $result2 = $pdo->query($query2);
                foreach($result2 as $value){
                   echo "<a href='".$value['link']."'>원문보기 > </a>";

                }
                  ?>
</div>
      </div>

      </div>


<br><br><br>
    <!-- /.container -->

</div>
</div>
    <!-- Footer -->


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
