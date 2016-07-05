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

    public function createTeamLead($conn){              //methods for create team leader accounts

        $fname=$_POST["fname"];         //assign variables
        $lname=$_POST["lname"];
        $nic=$_POST["nic"];
        $pwd=$_POST["pwd"];
        $email=$_POST["email"];
        $phone=$_POST["pnumber"];
        $join_date=date("Y/m/d h:i:sa");
        $age=$_POST["age"];
        $postal_code=$_POST['postal_code'];
        $address=$_POST['address'];
        $user_image=$_POST['user_image'];

        $sql="SELECT libraryid FROM library";                //select count of the library
        //$result=mysqli_query($conn,$sql);
        $num_of_rows_library=mysqli_num_rows(mysqli_query($conn,$sql));


        function generateLibraryId($postal_code,$num_of_rows){   //generate unique library id

            $count=1000+$num_of_rows++;
            return "RB-LB".$count.'-'.$postal_code;
        }

        $library_id=generateLibraryId($postal_code,$num_of_rows_library);

        $sql="SELECT * FROM teamleader WHERE NIC='$nic'";
        $result=mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)==0){

            $sql_insert="INSERT INTO teamleader VALUES ('$nic','$fname','$lname','$address','$email','$phone','$pwd','$age',1,'$join_date','$postal_code','$user_image')";

            $sql_insert_library="INSERT INTO library VALUES('$library_id','$postal_code','$address','$join_date','$nic')";

            if(mysqli_query($conn,$sql_insert)&&mysqli_query($conn,$sql_insert_library)){

                $data=array(                    //successfully account created alert
                    "query_result"=>1,
                    "NIC"=>$nic,
                    "name"=>$fname,
                    "libaray_id"=>$library_id,
                    "address"=>$address,
                    "user_image"=>$user_image
                );
            }
            else{

                $data=array("query_result"=>2);  //account create error alert
            }
        }
        else{

            $data=array("query_result"=>3);//team leader existing error
        }

        return $data;
    }

}