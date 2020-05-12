<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 6:35 PM
 */
require_once __DIR__."/../../models/Patient.php";
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['role']))
{
    $email = $_SESSION['email'];
    $objPatient = new Patient();
    $result = $objPatient->getPatientDetails($email);
    if($result)
    {
        $row = $result->fetch_assoc();
        $name = $row['p_name'];
        $number = $row['p_number'];
        $address = $row['p_address'];
    }
    else
        header('Location: ../login.php');
}
else
{
    header('Location: ../login.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Patient - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="../../../assets/sb-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../../assets/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <!-- Custom styles for this template-->
    <link href="../../../assets/sb-admin/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="home.php">Patient Dashboard</a>


<a href="../../controllers/LogoutController.php" style="margin-left: 75%">
<button class="btn-primary" >Logout</button></a>
<!--logout button here-->

</nav>


<div class="border text-justify" style="margin: 20% 20% 20% 20%; font-size: xx-large" >

   <div class="text-left" style="padding-left: 2%">
       Name : <?php echo $name; ?>
   </div>
    <div class="text-left" style="padding-left: 2%">
        Email : <?php echo $email; ?>
    </div>
    <div class="text-left" style="padding-left: 2%">
        Phone : <?php echo $number; ?>
    </div>
    <div class="text-left" style="padding-left: 2%">
        Address : <?php echo $address; ?>
    </div>

</div>



</body>

</html>

