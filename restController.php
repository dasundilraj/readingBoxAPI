<?php
/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 7/5/2016
 * Time: 12:00 PM
 */

require_once "RestHandler.php";
require_once "connection.php";

$action="";

if(isset($_GET['action'])){
    $action=$_GET['action'];

    switch($action){
        case "userLogin":
            $restHandler= new RestHandler();
            $restHandler->userLogin($conn);
            break;
    }
}

?>