<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 5:59 PM
 */

require_once __DIR__."/../utilities/Database.php";

class Patient
{
    function canLogin($email,$password)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from patient where `p_email`='$email' and `p_password`='$password'";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return true;
        return false;
    }

    function getPatientDetails($email)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from patient where `p_email`='$email'";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        else
            return false;
    }

    function getPatientDetailsFromId($p_id)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from patient where `p_id`='$p_id'";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        else
            return false;
    }

    function getAllPatientDetails()
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from patient";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        else
            return false;
    }

    function getPatientNameFromId($p_id)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from patient where `p_id`='$p_id'";
        $result = $con->query($query);
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            return $row['p_name'];
        }
        else
            return '';
    }

}