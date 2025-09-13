//request.php
<?php
session_start();
include("../common/db.php");
if(isset($_POST['signup'])){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
$user=$conn->prepare("Insert into `users`(`id`, `username`, `email`, `password`, `address`)
values(NULL,'$username', '$email', '$password', '$address');");
$result=$user->execute();
if($result){
    echo "New User registered";
    $_SESSION['user']=["username"=>$username,"email"=>$email];
    header("location:/discuss");
}else{
    echo"New User not registered";
}
}elseif(isset($_POST["login"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $username="";
    $query="select * from users where email='$email' and password = '$password'";
    $result = $conn->query($query);
  
    if($result->num_rows==1){
    foreach($result as $row){
        $username=$row["username"];
    }
    
    $_SESSION['user']=["username"=>$username,"email"=>$email];
    header("location:/discuss");
}else{
    echo"New User not registered";
}
}elseif(isset($_GET["logout"])){
    session_unset();
     header("location:/discuss");
}
?>
//index.php
<!DOCTYPE html>
<html length="en">
    <head>
        <title>Discuss Project</title>
        <?php include ('./client/commonFiles.php')?>
    </head>
    <body>
        <?php 
        session_start();
            include ('./client/header.php');
            if(isset($_GET['signup'] )&& !$_SESSION['user']['username'])
            {
                include ('./client/signup.php');
            }else if(isset($_GET['login'])&& $_SESSION['user']['username'])
            {
                include ('./client/login.php');
            }else{
                //
            }
        ?>
    </body>
</html>
//header.php
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"> <img src = "./public/logo.png"/></a>
   
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active"  href="./">Home</a>
        </li>
        <?php
        if($_SESSION['user']['username']){?>
        <li class="nav-item">
          <a class="nav-link" href="./server/requests.php?logout=true">Logout</a>
        </li>
        <?php  
          }
        ?><?php
        if(!$_SESSION['user']['username']){?>
        <li class="nav-item">
          <a class="nav-link" href="?login=true">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?signup=true">SignUp</a>
        </li>
        <?php  
          }
        ?>
        
        <li class="nav-item">
          <a class="nav-link" href="#">Category</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Latest Question</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
//question-details.php

<div class="container">
  <h1 class="heading">Question</h1>
  <?php
    include("./common/db.php");
        $query = "select * from questions where id = $id";
        $result=$conn->query($query);
        $row=$result->fetch_assoc();
        print_r($row);
  ?>


 if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            print_r($row); // ડેટા પ્રિન્ટ કરો (આને તમે HTML માં પણ બતાવી શકો)
        } else {
            echo "પ્રશ્ન મળ્યો નહીં.";
        }
    } else {
        echo "અયોગ્ય અથવા ખૂટતી પ્રશ્ન ID.";
    }
//question.php

    <div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="heading">Questions</h2>
            <?php
            include("./common/db.php");

            // Define variables from GET
            if (isset($_GET["c-id"])) {
                $cid = $_GET["c-id"];
                $query = "SELECT * FROM questions WHERE category_id = $cid";
            } else if (isset($_GET["u-id"])) {
                $uid = $_GET["u-id"];
                $query = "SELECT * FROM questions WHERE user_id = $uid";
            } else if (isset($_GET["latest"])) {
                $query = "SELECT * FROM questions ORDER BY id DESC";
            } else {
                $query = "SELECT * FROM questions";
            }

            $result = $conn->query($query);

            foreach ($result as $row) {
                $title = $row['title'];
                $id = $row['id'];
                echo "<div class='row question-list'>
                    <h4><a href='?q-id=$id'>$title</a></h4>
                </div>";
            }
            ?>
        </div>
        <div class="col-4">
            <?php include("categorylist.php"); ?>
        </div>
    </div>
</div>
