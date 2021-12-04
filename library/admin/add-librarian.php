<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['add']))
{
$bookname=$_POST['bookname'];

$author=md5($_POST['author']);

$sql="INSERT INTO  librarians(UserName,Password) VALUES(:bookname,:author)";
$query = $dbh->prepare($sql);
$query->bindParam(':bookname',$bookname,PDO::PARAM_STR);

$query->bindParam(':author',$author,PDO::PARAM_STR);


$query->execute();

// if ($result){

//     $_SESSION['msg']="Book Listed successfully";
//     header('location:manage-books.php');
// }
// else 
//  {
//  $_SESSION['error']="Something went wrong. Please try again";
//  header('location:manage-books.php');
//  }


$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Librarian Account Created successfully";
header('location:manage-librarians.php');
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
header('location:add-librarian.php');
}

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>E-Library | Add Librarian</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/admin-header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Add Librarian</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Book Info
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Librarian UserName<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookname" autocomplete="off"  required />
<label>Password<span style="color:red;">*</span></label>
<input class="form-control" type="password" name="author" minlength='8' autocomplete="off"  required />

</div>


<button type="submit" name="add" class="btn btn-info">Add Librarian </button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     
</body>
</html>
<?php } ?>
