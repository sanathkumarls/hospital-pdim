<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 5:59 PM
 */

require_once __DIR__."/../utilities/Database.php";

class Insurer
{
    function canLogin($email,$password)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from insurer where `i_email`='$email' and `i_password`='$password'";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return true;
        return false;
    }

    function getInsurerDetails($email)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from insurer where `i_email`='$email'";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        return false;
    }

    function getInsurerNameFromId($i_id)
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from insurer where `i_id`='$i_id'";
        $result = $con->query($query);
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            return $row['i_name'];
        }
        else
            return '';
    }

}