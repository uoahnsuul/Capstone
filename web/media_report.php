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
    .tool{
      font-size:40px;
      color:black;
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
      <h1 class="mt-4 mb-3" align="center">유사도 분석 결과</small></h1>
<br>


      <div class="row" align="center">
        <div class="col-lg-1 mt-4" style="font-size : 30px">
          <div><a style="color:#980000">
            <?php
            $cnt=0;
          $query2= 'SELECT * FROM output ORDER BY id DESC LIMIT 1' ;
                $result2 = $pdo->query($query2);
                foreach($result2 as $value){
                  if($value['max1']>'20'){
                    $cnt++;
                echo '<td>'.$value['max1'].'</td>';
                echo '%';
              }
              }?>
          </div>
        </div>

        <div class="col-lg-10 mt-4" style="font-size : 25px">
          <div><a style="color:#808080">
            <?php
            $query2= 'SELECT * FROM output INNER JOIN rawdata ON output.id1 = rawdata.ID ORDER BY output.id DESC LIMIT 1' ;
                  $result2 = $pdo->query($query2);
                  foreach($result2 as $value){
                  if($value['max1']>'20'){
                    $val=$value['title'];
                    $val2=$value['media'];
                    $val3=$value['ID'];

                    echo '<td>'.$value['media']. '</td>';
                    echo ' | ';
                  echo "<td> <a style='color:#808080' href ='report.php?var=$val&var2=$val2&var3=$val3'>  $val  </td>";
}
                }?>

          </a></div>
        </div>
      </div>

      <div class="row" align="center">
        <div class="col-lg-1 mt-4" style="font-size : 30px">
          <div><a style="color:#CC3D3D">
            <?php
          $query2= 'SELECT * FROM output ORDER BY id DESC LIMIT 1' ;
                $result2 = $pdo->query($query2);
                foreach($result2 as $value){

                if($value['max2']>'20'){
                    $cnt++;
                echo '<td>'.$value['max2'].'</td>';
                echo '%';
              }
              }?>


          </div>
        </div>
        <div class="col-lg-10 mt-4" style="font-size : 25px">
          <div><a style="color:#808080">
            <?php
            $query2= 'SELECT * FROM output INNER JOIN rawdata ON output.id2 = rawdata.ID ORDER BY output.id DESC LIMIT 1' ;
                  $result2 = $pdo->query($query2);
                  foreach($result2 as $value){
                  if($value['max2']>'20'){
                    $val=$value['title'];
                    $val2=$value['media'];
                    $val3=$value['ID'];

                    echo '<td>'.$value['media']. '</td>';
                    echo ' | ';
                  echo "<td> <a style='color:#808080' href ='report.php?var=$val&var2=$val2&var3=$val3'>  $val  </td>";
}
                }?>
          </a></div>
        </div>
      </div>

      <div class="row" align="center">
        <div class="col-lg-1 mt-4" style="font-size : 30px">
          <div><a style="color:#F15F5F">
            <?php
          $query2= 'SELECT * FROM output ORDER BY id DESC LIMIT 1' ;
                $result2 = $pdo->query($query2);
                foreach($result2 as $value){
                if($value['max3']>'20'){
                    $cnt++;
                echo '<td>'.$value['max3'].'</td>';
                echo '%';
              }
              }?>
            </div>
        </div>
        <div class="col-lg-10 mt-4" style="font-size : 25px">
          <div><a  style="color:#808080">
            <?php
            $query2= 'SELECT * FROM output INNER JOIN rawdata ON output.id3 = rawdata.ID ORDER BY output.id DESC LIMIT 1' ;
                  $result2 = $pdo->query($query2);
                  foreach($result2 as $value){
                  if($value['max3']>'20'){
                    $val=$value['title'];
                    $val2=$value['media'];
                    $val3=$value['ID'];

                    echo '<td>'.$value['media']. '</td>';
                    echo ' | ';
                  echo "<td> <a style='color:#808080' href ='report.php?var=$val&var2=$val2&var3=$val3'>  $val  </td>";
}
                }?>
          </a></div>
        </div>
      </div>

      <div class="row" align="center">
        <div class="col-lg-1 mt-4" style="font-size : 30px">
          <div><a style="color:#F29661">
            <?php
          $query2= 'SELECT * FROM output ORDER BY id DESC LIMIT 1' ;
                $result2 = $pdo->query($query2);
                foreach($result2 as $value){
                if($value['max4']>'20'){
                    $cnt++;
                echo '<td>'.$value['max4'].'</td>';
                echo '%';
              }
              }?></div>
        </div>
        <div class="col-lg-10 mt-4" style="font-size : 25px">
          <div><a style="color:#808080">
            <?php
            $query2= 'SELECT * FROM output INNER JOIN rawdata ON output.id4 = rawdata.ID ORDER BY output.id DESC LIMIT 1' ;
                  $result2 = $pdo->query($query2);
                  foreach($result2 as $value){
                    if($value['max4']>'20'){
                    $val=$value['title'];
                    $val2=$value['media'];
                    $val3=$value['ID'];

                    echo '<td>'.$value['media']. '</td>';
                    echo ' | ';
                  echo "<td> <a style='color:#808080' href ='report.php?var=$val&var2=$val2&var3=$val3'>  $val  </td>";
}
                }?></a></div>
        </div>
      </div>

      <div class="row" align="center">
        <div class="col-lg-1 mt-4" style="font-size : 30px">
          <div><a style="color:#FFC19E">
            <?php
            $query2= 'SELECT * FROM output ORDER BY id DESC LIMIT 1' ;
                  $result2 = $pdo->query($query2);
                  foreach($result2 as $value){
                    if($value['max5']>'20'){
                      $cnt++;
                  echo '<td>'.$value['max5'].'</td>';
                  echo '%';
                }
                }?>
          </div>
        </div>
        <div class="col-lg-10 mt-4" style="font-size : 25px">
          <div><a style="color:#808080">
            <?php
            $query2= 'SELECT * FROM output INNER JOIN rawdata ON output.id5 = rawdata.ID ORDER BY output.id DESC LIMIT 1' ;
                  $result2 = $pdo->query($query2);
                  foreach($result2 as $value){
                    if($value['max5']>'20'){
                    $val=$value['title'];
                    $val2=$value['media'];
                    $val3=$value['ID'];

                    echo '<td>'.$value['media']. '</td>';
                    echo ' | ';
                  echo "<td> <a style='color:#808080' href ='report.php?var=$val&var2=$val2&var3=$val3'>  $val  </td>";
}
                }?>

              <?php if($cnt==0) echo "유사한 기사가 없습니다.";

               ?>

          </a></div>
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
