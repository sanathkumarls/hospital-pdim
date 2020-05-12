<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 6:00 PM
 */

require_once __DIR__."/../utilities/Database.php";

class Transaction
{
    function addDoctorTransaction($p_id,$d_id,$items)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "insert into transaction values (null,$p_id,$d_id,CURRENT_TIMESTAMP,'$items',null,null,null,null,null,null)";
        return $con->query($query);
    }

    function getAllTransaction()
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from transaction";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        return false;
    }

    function insurerUpdateTransaction($t_id,$i_id,$status)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "update transaction set `i_id` = $i_id , `i_status` = $status , `i_timestamp` = CURRENT_TIMESTAMP where `t_id` = $t_id";
        return $con->query($query);
    }

    function getMedicalTransaction()
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from transaction t join patient p on p.p_id = t.p_id";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        return false;
    }

    function medicalUpdateTransaction($t_id,$m_id,$status)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "update transaction set `m_id` = $m_id , `m_status` = $status , `m_timestamp` = CURRENT_TIMESTAMP where `t_id` = $t_id";
        return $con->query($query);
    }
}