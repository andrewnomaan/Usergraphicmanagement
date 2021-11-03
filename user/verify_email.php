<?php
   include 'db_connect.php';
   include 'function.php';
//    taking email-id and token from url
       if($_GET['key'] && $_GET['token'])
       {
        $email = get_safe_value($conn,$_GET['key']);
        $token = get_safe_value($conn,$_GET['token']);
        $query = mysqli_query($conn,
        "SELECT * FROM `users` WHERE `token`='".$token."' and `email`='".$email."';"
        );
         if (mysqli_num_rows($query) > 0) {
        $row= mysqli_fetch_array($query);
        if($row['status'] == 0){
            // update status of verified user
            mysqli_query($conn,"UPDATE users set status=1 WHERE email='" . $email . "'");
            $msg = "Congratulations! Your email has been verified.";
            }else{
            $msg = "You have already verified your account with us";
            }
            } else {
            $msg = "This email is not registered with us";
            }
            }
            else
            {
            $msg = "Danger! Your something goes to wrong.";
            }

    ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Graphic Management - Zoyo</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- font-awesome link -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
    <style>
         body{
             width:100vw;
             height:100vh;
             display: flex;
             justify-content:center;
             align-items:center;
         }
    </style>
</head>
<div class="container">
<div class="box border-light bg-light">
<h1>User Account Activation</h1>
<p><?php echo $msg; ?></p>
<a href="signin.php"> Click here for homepage..</a>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>