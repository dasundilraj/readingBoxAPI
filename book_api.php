<?php
/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 6/9/2016
 * Time: 2:02 PM
 */


include_once "connection.php";

if(isset($_GET['action'])){

    $action=$_GET['action'];

    switch($action){

        case "addBook":
            addBook($conn);
            break;
        case "ListOFBookIDNotUpdated":
            ListOFBookIDNotUpdated($conn);
            break;
        case "AllListOFBookID":
            AllListOFBookID($conn);
            break;
        case "BookData":
            BookData($conn);
            break;
        case "updateBookData":
            updateBookData($conn);
            break;
        case "LibraryALLBookData":
            LibraryALLBookData($conn);
            break;
    }
}

/***********************************************************************************************************************
 ***************************FUNCTION ADD BOOKS TO SYSTEM****************************************************************
 ***************************FOR MAIN ADMIN ADD BOOK DATA***************************************************************/

function addBook($conn){

    $ISBN=$_POST['ISBN'];
    $price=$_POST['price'];
    $donate_date=$_POST['donate_date'];
    $donor_name=$_POST['donor_name'];
    $added_date=date("Y/m/d h:i:sa");
    $libaray_id=$_POST['library_id'];

    $sql_count="SELECT bookid FROM book";                     //count number of data in book table
    $result_count=mysqli_query($conn,$sql_count);
    $num_of_rows=mysqli_num_rows($result_count);

    function genarateBookId($ISBN,$num_of_rows){        //generate book id using ISBN

        $count=1+$num_of_rows++;

        return "RB-BK".$count."-".$ISBN;
    }

    $book_id=genarateBookId($ISBN,$num_of_rows);

    $sql="INSERT INTO book(bookid,ISBN,donatedate,status,library_libraryid,donor_name,added_date,price,updated)
                 VALUES('$book_id','$ISBN','$donate_date','Available','$libaray_id','$donor_name','$added_date',$price,'0')";

    if(mysqli_query($conn,$sql)){
        $data=array(
            "query_result"=>"1",
            "book_id"=>$book_id,
            "isbn"=>$ISBN,
            "library_id"=>$libaray_id
        );
    }
    else{
        $data=array("query_result"=>"0");
    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);

}

/***********************************************************************************************************************
 ***************************FUNCTION LIST OF BOOK DATA(GET)*************************************************************
 ***************************LIST OF BOOK ID FOR PARTICULAR LIBRARY*****************************************************/

function ListOFBookIDNotUpdated($conn){

    $library_id=$_POST['library_id'];

    $sql="SELECT bookid FROM book WHERE library_libraryid='$library_id' AND updated='0'";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_array($result)){
        $data[]=array("book_id"=>$row['bookid']);
    }
    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);
}
/***********************************************************************************************************************
 ***************************FUNCTION LIST OF BOOK DATA(GET)*************************************************************
 ***************************LIST OF BOOK ID FOR PARTICULAR LIBRARY*****************************************************/

function AllListOFBookID($conn){

    $library_id=$_POST['library_id'];

    $sql="SELECT bookid FROM book WHERE library_libraryid='$library_id' AND updated='1' AND status='Available' ";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_array($result)){
        $data[]=array("book_id"=>$row['bookid']);
    }
    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);
}

/***********************************************************************************************************************
 ***************************FUNCTION LIST OF BOOK DATA(GET)*************************************************************
 *******************************************************************************************************/

function BookData($conn){

    //$library_id=$_POST['library_id'];
    $book_id=$_POST['bookid'];

    $sql="SELECT * FROM book WHERE bookid='$book_id' ";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_array($result)){
        $data=array(
            "ISBN"=>$row['ISBN'],
            "title"=>$row['title'],
            "author_name"=>$row['author_name'],
            "price"=>$row['price']
        );
    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);
}

/***********************************************************************************************************************
 ***************************FUNCTION UPDATE BOOK DATA(GET)*************************************************************
 ***************************FOR TEAM LEADER ADD BOOK DATA**************************************************************/

function updateBookData($conn){

    $book_id=$_POST['book_id'];
    $title=$_POST['title'];
    $book_category=$_POST['book_category'];
    $author=$_POST['author'];
    $pub_date=$_POST['published_date'];

    $sql="UPDATE book SET title='$title',book_category='$book_category', author_name='$author',publishdate='$pub_date',updated='1'
                      WHERE bookid='$book_id' ";

    if(mysqli_query($conn,$sql)){
        $data=array("query_result"=>"1");
    }
    else{
        $data=array("query_result"=>"0");
    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);

}

/***********************************************************************************************************************
 ***************************FUNCTION GET ALL BOOK DATA(GET)*************************************************************
 **************************FOR TEAM LEADER BOOK DETAILS****************************************************************/

function LibraryALLBookData($conn){

    $library_id=$_POST['library_id'];

    $sql="SELECT * FROM book WHERE library_libraryid='$library_id' ORDER BY added_date DESC ";
    $result=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_array($result)){
        $data[]=array(
            "bookid"=>$row['bookid'],
            "ISBN"=>$row['ISBN'],
            "title"=>$row['title'],
            "book_category"=>$row['book_category'],
            "author"=>$row['author_name'],
            "publishdate"=>$row['publishdate'],
            "donor_name"=>$row['donor_name'],
            "donatedate"=>$row['donatedate'],
            "price"=>$row['price'],
            "status"=>$row['status']
        );
    }

    $json=$data;
    header('content-type: application/json');
    echo json_encode($json);

}
//    bookid, ISBN, title, book_category, author_name, publishdate, donatedate, status, library_libraryid, donor_name, added_date, price, updated
?>