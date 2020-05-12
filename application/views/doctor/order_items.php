<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 07/05/20
 * Time: 5:40 PM
 */

require_once __DIR__."/../../models/Patient.php";
require_once __DIR__."/../../models/Item.php";
require_once __DIR__."/../../models/Doctor.php";
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['role']))
{
    $d_email = $_SESSION['email'];
    $objPatient = new Patient();
    $objItem = new Item();
    $objDoctor = new Doctor();

    if(isset($_POST['submit']))
        $p_id = $_POST['submit'];
    else
        header('Location: ../login.php');

    $result1 = $objPatient->getPatientDetailsFromId($p_id);
    if($result1)
    {
        $row1 = $result1->fetch_assoc();
        $p_name = $row1['p_name'];
    }
    else
        header('Location: ../login.php');

    $result2 = $objItem->getAllItems();

    $result3 = $objDoctor->getDoctorDetails($d_email);
    if($result3)
    {
        $row3 = $result3->fetch_assoc();
        $d_id = $row3['d_id'];
    }

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

    <a class="navbar-brand mr-1" href="home.php">Doctor Order Items</a>


    <a href="../../controllers/LogoutController.php" style="margin-left: 75%">
        <button class="btn-primary" >Logout</button></a>
    <!--logout button here-->

</nav>

<div align="center" style="font-size: xx-large">
    You Are Ordering Items For <?php echo $p_name;?>
</div>
<br><br>
<form method="post" action="../../controllers/DoctorOrderItems.php">
<div class="accordion" align="center">
    <table class="table-bordered"  cellspacing="10px" border="10px" cellpadding="10%" align="center">
        <thead class="font-weight-bold">
        <tr>
            <td>Item Id</td>
            <td>Item Name</td>
            <td>Quantity</td>
        </tr>
        </thead>

        <?php

        if($result2)
        {
            $i=0;
            while($row = $result2->fetch_assoc())
            {
                echo "<tr>
            <td>".$row['i_id']."</td>
            <td>".$row['i_name']."</td>
            <td><input name='item".$i."' type='number' required></td>";
                $i++;
            }
            echo "<input name='itemCount' type='number' value='".$i."' hidden><input name='p_id' type='text' value='".$p_id."' hidden><input name='d_id' type='text' value='".$d_id."' hidden>";
        }
        else
            echo "</table> <div align='center' style='font-size: large' class='font-weight-bold'> No Items Found...</div>"

        ?>

    </table>
    <br>
    <br>
    <?php
    if($result2)
        echo "<button type='submit' name='submit' class='btn-primary' value='Submit'>Submit</button>";
    ?>
</div>

</form>


</body>

</html>


