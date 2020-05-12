<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 6:35 PM
 */
require_once __DIR__."/../../models/Patient.php";
require_once __DIR__."/../../models/Doctor.php";
require_once __DIR__."/../../models/Insurer.php";
require_once __DIR__."/../../models/Transaction.php";
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['role']))
{
    $i_email = $_SESSION['email'];
    $objPatient = new Patient();
    $objDoctor = new Doctor();
    $objInsurer = new Insurer();
    $objTransaction = new Transaction();

    $result1 = $objInsurer->getInsurerDetails($i_email);
    if($result1)
    {
        $row1 = $result1->fetch_assoc();
        $i_name = $row1['i_name'];
        $i_id = $row1['i_id'];
    }
    else
        header('Location: ../login.php');

    $result2 = $objTransaction->getAllTransaction();

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

    <title>Insurer - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="../../../assets/sb-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../../assets/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <!-- Custom styles for this template-->
    <link href="../../../assets/sb-admin/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="home.php">Insurer Dashboard</a>


    <a href="../../controllers/LogoutController.php" style="margin-left: 75%">
        <button class="btn-primary" >Logout</button></a>
    <!--logout button here-->

</nav>

<div align="center" style="font-size: xx-large">
    Welcome <?php echo $i_name;?> !!!
</div>
<br><br>
<div class="accordion">
    <table class="table-bordered" width="100%" cellspacing="10px" border="10px" cellpadding="10%" align="center">
        <thead class="font-weight-bold">
        <tr>
            <td>Transaction Id</td>
            <td>Patient Name</td>
            <td>Doctor Name</td>
            <td>Items</td>
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
                    $button = "<button class='btn-success' name='submit' value='" . $row['t_id'] . "'>Approved</button>";
                }
                elseif ($row['i_status'] == 2)
                {
                    $button = "<button class='btn-danger' name='submit' value='" . $row['t_id'] . "'>Rejected</button>";
                }
                else
                {
                    $button = "<form method='post' action='../../controllers/InsurerApproveTransaction.php'><button class='btn-success' name='submit' value='" . $row['t_id'] . "'>Approve</button><input name='i_id' type='text' value='".$i_id."' hidden></form>
                            <form method='post' action='../../controllers/InsurerRejectTransaction.php'><button class='btn-danger' name='submit' value='" . $row['t_id'] . "'> Reject </button><input name='i_id' type='text' value='".$i_id."' hidden></form>";
                }


                echo "<tr>
            <td>".$row['t_id']."</td>
            <td>".$objPatient->getPatientNameFromId($row['p_id'])."</td>
            <td>".$objDoctor->getDoctorNameFromId($row['d_id'])."</td>
            <td>".$value."</td>
            <td>".$button."
            </td>
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

