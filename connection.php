<?php
/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 5/14/2016
 * Time: 2:22 PM
 */
//create database connection

$SERVER_NAME="localhost";
$USER_NAME="root";
$PASSWORD="";
$DB_NAME="readingbox";

//create connection

$conn=mysqli_connect($SERVER_NAME,$USER_NAME,$PASSWORD,$DB_NAME);

//check database connection

if(!$conn){
    die("Connection Failed".mysqli_connect_error());
}



?>