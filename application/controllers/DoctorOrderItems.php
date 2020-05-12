<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 07/05/20
 * Time: 6:27 PM
 */

require_once __DIR__."/../models/Item.php";
require_once __DIR__."/../models/Transaction.php";

$objDoctorOrderItems = new DoctorOrderItems();

if(isset($_POST['submit']))
    $objDoctorOrderItems->orderItems();


class DoctorOrderItems
{
    function orderItems()
    {
        $i = 0;
        $count = $_POST['itemCount'];
        $p_id = $_POST['p_id'];
        $d_id = $_POST['d_id'];

        $objItem = new Item();
        $result = $objItem->getAllItems();

        if($count != $result->num_rows)
        {
            echo "<script>alert('No Items'); window.location.href='../views/doctor/home.php'</script>";
            return;
        }


        if($result)
        {
            while($row = $result->fetch_assoc())
            {
                $a[$row['i_name']] = $_POST['item'.$i];
                $i++;
            }

            $objTransaction = new Transaction();
            $objTransaction->addDoctorTransaction($p_id,$d_id,json_encode($a));

            echo "<script>alert('Items Ordered Successfully'); window.location.href='../views/doctor/home.php'</script>";
        }
        else
            echo "<script>alert('No Items'); window.location.href='../views/doctor/home.php'</script>";

    }
}