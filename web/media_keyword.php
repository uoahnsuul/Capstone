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
    td{
      margin: 0;
    }
    </style>

</head>

<body style="background-color:#f7f7f7">


<?php include('includes/header.php');?>
    <!-- Page Content -->
    <div id="cont">
    <div class="container">
<br>
      <h1 class="mt-4 mb-3" align="center">관련 기사 목록</small></h1>
<br>


      <div class="row" align="center">
        <div class="col-lg-12 mt-4" style="font-size : 25px">
          <div align="center"><a style="color:#808080" align="center">
            <?php
            $query2= 'SELECT * FROM output INNER JOIN rawdata ON output.id1 = rawdata.ID ORDER BY output.id DESC LIMIT 1' ;
                  $result2 = $pdo->query($query2);
                  foreach($result2 as $value){
                  if($value['max1']>'20'){
                    $val=$value['title'];
                    $val2=$value['media'];
                    $val3=$value['ID'];
                    echo "      ";
                  echo "1. ";

                    echo '<td>'.$value['media']. '</td>';
                    echo ' | ';
                  echo "<td> <a style='color:#808080' href ='report_key.php?var=$val&var2=$val2&var3=$val3'>  $val  </td>";
}
                }?>

          </a></div>
        </div>
      </div>

      <div class="row" align="center">

        <div class="col-lg-12 mt-4" style="font-size : 25px">
          <div><a style="color:#808080">
            <?php
            $query2= 'SELECT * FROM output INNER JOIN rawdata ON output.id2 = rawdata.ID ORDER BY output.id DESC LIMIT 1' ;
                  $result2 = $pdo->query($query2);
                  foreach($result2 as $value){
                  if($value['max2']>'20'){
                    $val=$value['title'];
                    $val2=$value['media'];
                    $val3=$value['ID'];

echo "2. ";
                    echo '<td>'.$value['media']. '</td>';
                    echo ' | ';
                  echo "<td> <a style='color:#808080' href ='report_key.php?var=$val&var2=$val2&var3=$val3'>  $val  </td>";
}
                }?>
          </a></div>
        </div>
      </div>

      <div class="row" align="center">

        <div class="col-lg-12 mt-4" style="font-size : 25px">
          <div><a  style="color:#808080">
            <?php
            $query2= 'SELECT * FROM output INNER JOIN rawdata ON output.id3 = rawdata.ID ORDER BY output.id DESC LIMIT 1' ;
                  $result2 = $pdo->query($query2);
                  foreach($result2 as $value){
                  if($value['max3']>'20'){
                    $val=$value['title'];
                    $val2=$value['media'];
                    $val3=$value['ID'];
echo "3. ";
                    echo '<td>'.$value['media']. '</td>';
                    echo ' | ';
                  echo "<td> <a style='color:#808080' href ='report_key.php?var=$val&var2=$val2&var3=$val3'>  $val  </td>";
}
                }?>
          </a></div>
        </div>
      </div>

      <div class="row" align="center">

        <div class="col-lg-12 mt-4" style="font-size : 25px">
          <div><a style="color:#808080">
            <?php
            $query2= 'SELECT * FROM output INNER JOIN rawdata ON output.id4 = rawdata.ID ORDER BY output.id DESC LIMIT 1' ;
                  $result2 = $pdo->query($query2);
                  foreach($result2 as $value){
                    if($value['max4']>'20'){
                    $val=$value['title'];
                    $val2=$value['media'];
                    $val3=$value['ID'];
echo "4. ";
                    echo '<td>'.$value['media']. '</td>';
                    echo ' | ';
                  echo "<td> <a style='color:#808080' href ='report_key.php?var=$val&var2=$val2&var3=$val3'>  $val  </td>";
}
                }?></a></div>
        </div>
      </div>

      <div class="row" align="center">

        <div class="col-lg-12 mt-4" style="font-size : 25px">
          <div><a style="color:#808080">
            <?php
            $query2= 'SELECT * FROM output INNER JOIN rawdata ON output.id5 = rawdata.ID ORDER BY output.id DESC LIMIT 1' ;
                  $result2 = $pdo->query($query2);
                  foreach($result2 as $value){
                    if($value['max5']>'20'){
                    $val=$value['title'];
                    $val2=$value['media'];
                    $val3=$value['ID'];
echo "5. ";
                    echo '<td>'.$value['media']. '</td>';
                    echo ' | ';
                  echo "<td> <a style='color:#808080' href ='report_key.php?var=$val&var2=$val2&var3=$val3'>  $val  </td>";
}
                }?>



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
