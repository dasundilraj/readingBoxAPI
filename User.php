<?php

/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 7/5/2016
 * Time: 1:24 PM
 */

class User
{
   public function userLogin($conn){                    //methods for user login

        $userName=$_POST['user_id'];
        $password=$_POST['user_pwd'];

        $sql="SELECT * FROM teamleader WHERE NIC='$userName' && pwd='$password'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);

        if((mysqli_num_rows($result)!=0)&&($row['attribute']==0)){

            $data=array(                //data array for main admin
                "query_result"=>"1",
                "attribute"=>"0",
                "user_NIC"=>$row['NIC'],
                "user_fname"=>$row['firstname']
            );
        }

        else if((mysqli_num_rows($result)!=0)&&($row['attribute']==1)){

            $sql="SELECT libraryid FROM library WHERE teamleader_NIC='$userName'";
            $row_lib=mysqli_fetch_array(mysqli_query($conn,$sql));

            $data=array(                //data array for Team Leader
                "query_result"=>"1",
                "attribute"=>"1",
                "user_NIC"=>$row['NIC'],
                "user_fname"=>$row['firstname'],
                "user_image"=>$row['user_image'],
                "Library_id"=>$row_lib['libraryid']
            );
        }
        else{
            $data=array();             //data array empty for Error request
        }

        return $data;

        }

}