<?php
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

    <title>BloodBank & Donor | 주문 확인</title>
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

<body>

<?php include('includes/header.php');?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">주문 확인하기</h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">주문확인</li>
        </ol>
            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
        <!-- Content Row -->
        <form name="donar" method="post">


<div class="row">
<div class="col-lg-4 mb-4">
<div class="font-italic">주문 번호 </div>
<div><textarea class="form-control" name="ordernum"></textarea></div>
</div>

</div>

<div class="row">
<div class="col-lg-4 mb-4">
<div><input type="submit" name="submit" class="btn btn-primary" value="submit" style="cursor:pointer"></div>
</div>
</div>
       <!-- /.row -->
</form>

        <div class="row">
                   <?php
            if(isset($_POST['submit']))
            {
            $status=1;
            $ordernum=$_POST['ordernum'];
            $sql = "SELECT * from orderblood A inner join hospital B on A.hospital_id=B.name where (ordernum='$ordernum')";
            $query = $dbh -> prepare($sql);
            $query->bindParam(':ordernum',$ordernum,PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
            foreach($results as $result)
            { ?>
            <div class="col-lg-4  portfolio-item">
                <div class="card h-100">

                    <div class="card-block">
                        <h4 class="card-title"><a>주문 내역</a></h4>
                        <p class="card-text"><b> 주문 번호 :</b> <?php echo htmlentities($result->ordernum);?> </p>
                        <p class="card-text"><b> 병원 이름 :</b> <?php echo htmlentities($result->name);?></p>
                        <p class="card-text"><b> 병원 주소 :</b> <?php echo htmlentities($result->address);?></p>
                        <p class="card-text"><b> 병원 연락처 :</b> <?php echo htmlentities($result->contactno);?></p>
                        <p class="card-text"><b> 주문 혈액 :</b> <?php echo htmlentities($result->bloodtype);?></p>
                        <p class="card-text"><b> 주문 수량 :</b> <?php echo htmlentities($result->amount);?></p>
                        <p class="card-text"><b> 메세지 :</b> <?php echo htmlentities($result->message);?></p>
                    </div>
                </div>
            </div>

            <?php }}
else
{
echo htmlentities("No Record Found");

}


            } ?>





        </div>




</div>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
