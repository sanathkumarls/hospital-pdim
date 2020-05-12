<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 07/05/20
 * Time: 7:58 PM
 */

require_once __DIR__."/../models/Transaction.php";

$objInsurerRejectTransaction = new InsurerRejectTransaction();

if(isset($_POST['submit']))
    $objInsurerRejectTransaction->rejectTransaction();

class InsurerRejectTransaction
{
    function rejectTransaction()
    {
        $t_id = $_POST['submit'];
        $i_id = $_POST['i_id'];
        $objTransaction = new Transaction();
        $objTransaction->insurerUpdateTransaction($t_id,$i_id,2);
        echo "<script>
                        alert('Transaction Rejected Successfully');
                       window.location.href='../views/insurer/home.php';
                </script>";
    }
}