<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 6:35 PM
 */

require_once __DIR__."/../../models/Medical.php";
require_once __DIR__."/../../models/Transaction.php";
require_once __DIR__."/../../models/Patient.php";
require_once __DIR__."/../../models/Doctor.php";
require_once __DIR__."/../../models/Insurer.php";
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['role']))
{
    $email = $_SESSION['email'];
    $objMedical = new Medical();
    $objTransaction = new Transaction();
    $objPatient = new Patient();
    $objDoctor = new Doctor();
    $objInsurer = new Insurer();

    $result1 = $objMedical->getMedicalDetails($email);
    if($result1)
    {
        $row1 = $result1->fetch_assoc();
        $m_name = $row1['m_name'];
        $m_id = $row1['m_id'];
    }
    else
        header('Location: ../login.php');

    $result2 = $objTransaction->getMedicalTransaction();
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

    <title>Medical - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="../../../assets/sb-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../../assets/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <!-- Custom styles for this template-->
    <link href="../../../assets/sb-admin/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="home.php">Medical Dashboard</a>


    <a href="../../controllers/LogoutController.php" style="margin-left: 75%">
        <button class="btn-primary" >Logout</button></a>
    <!--logout button here-->

</nav>

<div align="center" style="font-size: xx-large">
    Welcome <?php echo $m_name;?> !!!
</div>
<br><br>
<div class="accordion">
    <table class="table-bordered" width="100%" cellspacing="10px" border="10px" cellpadding="10%" align="center">
        <thead class="font-weight-bold">
        <tr>
            <td>Patient Name</td>
            <td>Doctor Name</td>
            <td>Insurer Name</td>
            <td>Items</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
        </thead>

        <?php

        if($result2)
        {
            while($row = $result2->fetch_assoc())
            {

                $items_org = json_decode($row['d_items'],true);
                $items_key = array_keys($items_org);
                $items_val = array_values($items_org);
                $count = sizeof($items_org);

                $value = "";
                for($i=0; $i < $count; $i++)
                {
                    $value .= $items_key[$i]." : ".$items_val[$i];
                    if($i != $count-1)
                        $value.=" , ";
                }


                if ($row['i_status'] == 1)
                {
                    $button1 = "<button class='btn-success' name='submit' value='" . $row['t_id'] . "'>Approved</button>";
                    $button2 = "<form method='post' action='../../controllers/MedicalIssueItems.php'>
                                <button class='btn-primary' name='submit' value='".$row['t_id']."'>Issue</button>
                                <input name='m_id' type='text' value='".$m_id."' hidden>
                                </form>";
                }
                elseif ($row['i_status'] == 2)
                {
                    $button1 = "<button class='btn-danger' name='submit' value='" . $row['t_id'] . "'>Rejected</button>";
                    $button2 = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp; --- ";
                }
                else
                {
                    $button1 = "<button class='btn-primary' name='submit' value='" . $row['t_id'] . "'>Pending</button>";
                    $button2 = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp; --- ";
                }

                if($row['m_status'] == 1)
                {
                    $button2 = "<button class='btn-success' name='submit' value='".$row['t_id']."'>Already Issued</button>";
                }

                if($objInsurer->getInsurerNameFromId($row['i_id']) == "")
                    $i_name = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp; --- ";
                else
                    $i_name = $objInsurer->getInsurerNameFromId($row['i_id']);


                echo "<tr>
            <td>".$objPatient->getPatientNameFromId($row['p_id'])."</td>
            <td>".$objDoctor->getDoctorNameFromId($row['d_id'])."</td>
            <td>".$i_name."</td>
            <td>".$value."</td>
            <td>".$button1."</td>
            <td>".$button2."</td>
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


