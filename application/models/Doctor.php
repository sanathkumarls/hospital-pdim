<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 5:59 PM
 */

require_once __DIR__."/../utilities/Database.php";

class Doctor
{
    function canLogin($email,$password)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from doctor where `d_email`='$email' and `d_password`='$password'";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return true;
        return false;
    }

    function getDoctorDetails($email)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from doctor where `d_email`='$email'";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        return false;
    }

    function getDoctorNameFromId($d_id)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from doctor where `d_id`='$d_id'";
        $result = $con->query($query);
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            return $row['d_name'];
        }
        else
            return '';
    }
}