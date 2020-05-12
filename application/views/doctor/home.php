<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 6:35 PM
 */
require_once __DIR__."/../../models/Patient.php";
require_once __DIR__."/../../models/Doctor.php";
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['role']))
{
    $d_email = $_SESSION['email'];
    $objPatient = new Patient();
    $objDoctor = new Doctor();

    $result1 = $objDoctor->getDoctorDetails($d_email);
    if($result1)
    {
        $row = $result1->fetch_assoc();
        $d_name = $row['d_name'];
    }
    else
        header('Location: ../login.php');

    $result2 = $objPatient->getAllPatientDetails();

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

    <title>Doctor - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="../../../assets/sb-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../../assets/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <!-- Custom styles for this template-->
    <link href="../../../assets/sb-admin/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="home.php">Doctor Dashboard</a>


    <a href="../../controllers/LogoutController.php" style="margin-left: 75%">
        <button class="btn-primary" >Logout</button></a>
    <!--logout button here-->

</nav>

<div align="center" style="font-size: xx-large">
    Welcome <?php echo $d_name;?> !!!
</div>
<br><br>
<div class="accordion">
    <table class="table-bordered" width="100%" cellspacing="10px" border="10px" cellpadding="10%" align="center">
        <thead class="font-weight-bold">
        <tr>
            <td>Patient Id</td>
            <td>Patient Name</td>
            <td>Patient Email</td>
            <td>Patient Number</td>
            <td>Patient Address</td>
            <td>Action</td>
        </tr>
        </thead>

        <?php

        if($result2)
        {
            while($row = $result2->fetch_assoc())
            {
                echo "<tr>
            <td>".$row['p_id']."</td>
            <td>".$row['p_name']."</td>
            <td>".$row['p_email']."</td>
            <td>".$row['p_number']."</td>
            <td>".$row['p_address']."</td>
            <td><form method='post' action='order_items.php'><button class='btn-primary' name='submit' value='".$row['p_id']."'>Order Items</button></form></td>
        </tr>";
            }
        }
        else
            echo "</table> <div align='center' style='font-size: large' class='font-weight-bold'> No Records Found...</div>"

        ?>

    </table>
</div>




</body>

</html>

