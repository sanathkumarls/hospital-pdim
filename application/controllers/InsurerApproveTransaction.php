<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 07/05/20
 * Time: 7:58 PM
 */

require_once __DIR__."/../models/Transaction.php";

$objInsurerApproveTransaction = new InsurerApproveTransaction();

if(isset($_POST['submit']))
    $objInsurerApproveTransaction->approveTransaction();



class InsurerApproveTransaction
{
    function approveTransaction()
    {
        $t_id = $_POST['submit'];
        $i_id = $_POST['i_id'];
        $objTransaction = new Transaction();
        $objTransaction->insurerUpdateTransaction($t_id,$i_id,1);
        echo "<script>
                        alert('Transaction Approved Successfully');
                       window.location.href='../views/insurer/home.php';
                </script>";
    }
}