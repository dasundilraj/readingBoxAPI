<?php

/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 7/7/2016
 * Time: 11:50 AM
 */
class Transaction
{

    public function addTransaction($conn){                  //for add transaction in team leader view

        $book_id = $_POST['book_id'];
        $member_id = $_POST['member_id'];
        $issued_date = $_POST['issued_date'];
        $submitted_date = $_POST['submitted_date'];

        $sql_insert="INSERT INTO transaction(date, submitiondate, member_memberid, book_bookid) VALUES ('$issued_date','$submitted_date','$member_id','$book_id')";
        $sql_update="UPDATE book SET status='Issued' WHERE bookid='$book_id'";

        if (mysqli_query($conn, $sql_insert)&&mysqli_query($conn,$sql_update)) {
            $data=array("query_result"=>"1");
        }
        else{
            $data=array("query_result"=>"0");
        }

        return $data;
    }

    public function transactionDetails($conn){                    //for view transaction details in team leader view

        $team_lead_nic=$_POST['team_lead_nic'];
        $sql="SELECT * FROM transaction JOIN member ON transaction.member_memberid=member.memberid WHERE member.teamleader_NIC='$team_lead_nic'";
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_array($result)){
            $data[]=array(
                "member_id"=>$row['member_memberid'],
                "book_id"=>$row['book_bookid'],
                "issued_date"=>$row['date'],
                "submition_date"=>$row['submitiondate'],
                "address"=>$row['address'],
                "email"=>$row['email'],
                "phone"=>$row['phone'],
                "name"=>$row['firstname']." ".$row['lastname']

            );
        }
        return $data;
    }

    public function returnBooks($conn)                              //for return book in transaction view
    {

        $book_id = $_POST['bookid'];

        $sql_delete = "DELETE FROM transaction WHERE book_bookid='$book_id'";
        $sql_update = "UPDATE book SET status='Available' WHERE bookid='$book_id'";

        if (mysqli_query($conn, $sql_delete) && mysqli_query($conn, $sql_update)) {
            $data = array("query_result" => "1");
        } else {
            $data = array("query_result" => "0");
        }
        return $data;
    }
}