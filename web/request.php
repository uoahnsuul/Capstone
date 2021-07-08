<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['send']))
  {
$name=$_POST['hospital_name'];
$blood=$_POST['group'];
$amount=$_POST['amount'];
$message=$_POST['message'];
$today = date("Ymd");
$rand = rand(0,9999);
$ordernum = $today . $rand;
$sql="INSERT INTO orderblood(ordernum,hospital_id,bloodtype,amount,message) VALUES(:ordernum,:name,:blood,:amount,:message)";
$query = $dbh->prepare($sql);
$query->bindParam(':ordernum',$ordernum,PDO::PARAM_STR);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':blood',$blood,PDO::PARAM_STR);
$query->bindParam(':amount',$amount,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
  $msg="주문이 완료되었습니다. 주문번호 : $ordernum";
  $sql="UPDATE blood SET amount=amount-'$amount' where blood.bloodtype = '$blood'";
  $hy=$dbh->prepare($sql);
  $hy->execute();
  $lastInsertId = $dbh->lastInsertId();
}
else
{
$error="Something went wrong. Please try again";
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

    <title>BloodBank & Donor | 혈액 주문하기 </title>
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
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
        <h1 class="mt-4 mb-3">혈액 주문</h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">혈액 주문</li>
        </ol>

        <!-- Content Row -->
        <div class="row">
            <!-- Map Column -->
              <div class="col-lg-8 mb-4">

                <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
                  else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                <form name="sentMessage"  method="post">

                  <div class="form-group">
                    <div class="controls">병원 선택<span style="color:red">*</span> </div>
                            <select name="hospital_name" class="form-control">
                              <?php
                              $sql = "SELECT * from hospital ";
                              $query = $dbh -> prepare($sql);
                              $query->execute();
                              $results=$query->fetchAll(PDO::FETCH_OBJ);
                              $cnt=1;
                              if($query->rowCount() > 0)
                              {
                              foreach($results as $result)
                              {               ?>
                              <option value="<?php echo htmlentities($result->name);?>"><?php echo htmlentities($result->name);?></option>
                              <?php }} ?>
                            </select>
                        </div>


                    <div class="form-group">
                      <div class="controls">주문 혈액<span style="color:red">*</span> </div>
                    <select name="group" class="form-control">
                      <?php $sql = "SELECT * from  blood ";
                      $query = $dbh -> prepare($sql);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                      if($query->rowCount() > 0)
                      {
                      foreach($results as $result)
                      {               ?>
                      <option value="<?php echo htmlentities($result->bloodtype);?>"><?php echo htmlentities($result->bloodtype);?></option>
                      <?php }} ?>
                    </select>
                   </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>주문 수량 (단위:Unit)<span style="color:red">*</span></label>
                            <input type="number" class="form-control" id="amount" name="amount" required data-validation-required-message="주문 수량을 입력하세요">
                        </div>
                    </div>

                    <div class="control-group form-group">
                        <div class="controls">
                            <label>메세지:</label>
                            <textarea rows="10" cols="100" class="form-control" id="message" name="message" maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" name="send"  class="btn btn-primary">주문하기</button>
                </form>
            </div>
          </div>


        <!-- /.row -->
</div>


    <!-- /.container -->


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Contact form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

</body>

</html>
