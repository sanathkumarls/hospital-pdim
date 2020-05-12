<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 5:59 PM
 */

require_once __DIR__."/../utilities/Database.php";

class Medical
{
    function canLogin($email,$password)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from medical where `m_email`='$email' and `m_password`='$password'";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return true;
        return false;
    }

    function getMedicalDetails($email)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from medical where `m_email`='$email'";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        else
            return false;
    }
}