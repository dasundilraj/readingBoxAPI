<?php

/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 7/6/2016
 * Time: 9:38 AM
 */
class Library
{

    public function getListOfLibraryID($conn){                          //function for get library id list

        $sql="SELECT libraryid FROM library ORDER BY startdate DESC ";
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_array($result)){
            $data[]=array("library_id"=>$row['libraryid']);

        }

        return $data;
    }

    public function getLibraryData($conn){                             //function for get library data

        $library_id = $_POST['library_id'];

        $sql="SELECT * FROM library WHERE libraryid='$library_id'";
        $result=mysqli_query($conn,$sql);

        $row=mysqli_fetch_array($result);

        if($result){
            $data=array("library_id"=>$row['libraryid'],"postalcode"=>$row['postalcode'],"address"=>$row['address'],"startdate"=>$row['startdate'],"teamleader_NIC"=>$row['teamleader_NIC']);
        }
        return $data;
    }
}