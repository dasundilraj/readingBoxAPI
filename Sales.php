<?php

/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 7/7/2016
 * Time: 10:37 AM
 */
class Sales
{

    public function bookSale($conn){                        //for add sales into the system
        $library_id=$_POST['library_id'];
        $team_lead_id=$_POST['team_lead_id'];
        $book_id=$_POST['book_id'];
        $date=date("Y/m/d h:i:sa");
        $buyer_name=$_POST['buyer_name'];
        $address=$_POST['address'];
        $email=$_POST['buyer_email'];
        $mobile=$_POST['mobile'];

        $sql_insert="INSERT INTO sales(date, buyerName, buyerAddress, buyerMobile, BuyerEmail, book_bookid, book_library_libraryid, teamleader_NIC) VALUES ('$date','$buyer_name','$address','$mobile','$email','$book_id','$library_id','$team_lead_id')";
        $sql_update="UPDATE book SET status='Sold' WHERE bookid='$book_id'";

        if(mysqli_query($conn,$sql_insert)&&mysqli_query($conn,$sql_update)){
            $data=array("query_result"=>1);
        }
        else{
            $data=array("query_result"=>0);
        }

        return $data;
    }

    public function viewSalesDetails($conn){            //for get sales details into the team leader view

        $team_lead_nic=$_POST['team_lead_nic'];

        $sql="SELECT * FROM sales JOIN book ON sales.book_bookid=book.bookid WHERE sales.teamleader_NIC='$team_lead_nic' ";
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_array($result)){
            $data[]=array(
                "date"=>$row['date'],
                "buyerName"=>$row['buyerName'],
                "buyerAddress"=>$row['buyerAddress'],
                "buyerMobile"=>$row['buyerMobile'],
                "BuyerEmail"=>$row['BuyerEmail'],
                "book_bookid"=>$row['book_bookid'],
                "title"=>$row['title'],
                "author_name"=>$row['author_name'],
                "book_category"=>$row['book_category'],

            );
        }
        return $data;
    }
}