<?php
/**
 * Created by PhpStorm.
 * User: sanathls
 * Date: 05/05/20
 * Time: 5:59 PM
 */

require_once __DIR__."/../utilities/Database.php";

class Item
{
    function getAllItems()
    {
        $db = new Database();
        $con = $db->open_connection();
        $query = "select * from item";
        $result = $con->query($query);
        if($result->num_rows > 0)
            return $result;
        return false;
    }
}