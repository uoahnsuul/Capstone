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

    <title>BloodBank & Donor | 헌혈 내역</title>
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
        <h1 class="mt-4 mb-3">헌혈 기록 조회<small></small></h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">헌혈 내역</li>
        </ol>
            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
        <!-- Content Row -->
        <form name="donar" method="post">


<div class="row">
<div class="col-lg-4 mb-4">
<div class="font-italic">이름 </div>
<div><textarea class="form-control" name="donor"></textarea></div>
</div>
<div class="col-lg-4 mb-4">
<div class="font-italic">주민등록번호 </div>
<div><textarea class="form-control" name="RRN" required></textarea></div>
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
            $donor=$_POST['donor'];
            $RRN=$_POST['RRN'];
            $sql = "SELECT * from donation A inner join donor B on A.donor_id=B.Name where ('$donor'=B.Name) and ('$contactno'=B.RRN)";
            $query = $dbh -> prepare($sql);
            $query->bindParam(':donor',$donor,PDO::PARAM_STR);
            $query->bindParam(':RRN',$RRN,PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            if($query->rowCount() > 0)
            {
            foreach($results as $result)
            { ?>
            <div class="col-lg-4  portfolio-item">
                <div class="card h-100">

                    <div class="card-block">

                        <p class="card-title"><b> 예약 번호 :</b> <?php echo htmlentities($result->id);?></p>
                        <p class="card-text"><b> 헌혈자 이름 :</b> <?php echo htmlentities($result->Name);?> </p>
                        <p class="card-text"><b> 헌혈자 나이 :</b> <?php echo htmlentities($result->Age);?> </p>
                        <p class="card-text"><b> 헌혈자 성별 :</b> <?php echo htmlentities($result->Gender);?> </p>
                        <p class="card-text"><b> 헌혈자 연락처 :</b> <?php echo htmlentities($result->MobileNumber);?> </p>
                        <p class="card-text"><b> 혈액형 :</b> <?php echo htmlentities($result->BloodGroup);?></p>
                        <p class="card-text"><b> 헌혈 날짜 :</b> <?php echo htmlentities($result->donationdate);?></p>
                    </div>
                </div>
            </div>

            <?php }}
else
{
echo htmlentities("헌혈 기록이 없습니다.");

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
