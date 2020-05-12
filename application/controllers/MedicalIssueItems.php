<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 07/05/20
 * Time: 11:43 PM
 */

require_once __DIR__."/../models/Transaction.php";

$objMedicalIssueItems =  new MedicalIssueItems();

if(isset($_POST['submit']))
    $objMedicalIssueItems->issueItems();

class MedicalIssueItems
{
    function issueItems()
    {
        $t_id = $_POST['submit'];
        $m_id = $_POST['m_id'];
        $objTransaction = new Transaction();
        $objTransaction->medicalUpdateTransaction($t_id,$m_id,1);
        echo "<script>
                        alert('Transaction Issued Successfully');
                       window.location.href='../views/medical/home.php';
                </script>";
    }
}