<?php
  include 'db_connect.php';
  include 'function.php';
  $email_err="";
  $password_err="";
  $main_err="";
  $email="";
  $er=0;
  if(isset($_POST['submit'])){
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    if($email==""){
        $email_err="Plz enter your email";
        $er++;
    }
    if($password==""){
        $password_err="Plz enter your password";
        $er++;
    }
    if($er==0){
        // checking user email id and password for login
        $sql="SELECT * FROM users where email='$email'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            if(password_verify($password,$row['password']))
            {
             if($row['status']==1){
                $_SESSION['loggedin']=true;
                $_SESSION['name']=$row['name'];
                $_SESSION['id']=$row['id'];                  
            ?>
            <script>
                // if login moved to user_index.php
                alert("Login Successfully");
                window.location="user_index.php";
            </script>
          <?php
             }
             else{
                 $main_err="Please verify your email first";
             }
            }
            else{
                $main_err="Enter correct login details";
            }
        }
        else{
            $main_err="Enter correct login details";
        }
    }
    
  }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Login - Zoyo</title>
    <link rel="stylesheet" href="css/loginstyle.css">
</head>

<body>
    <div class="container loginform">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="aduraloginhead py-3">
                    <h2>Zoyo Login</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="loginformdiv">
                    <form action="" method="post">
                    <div class="form-group">
                        <span class="" class="invalidalert" style="color:red;"><?php echo $main_err;?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email ?>">
                        <span class="" class="invalidalert" style="color:red;"><?php echo $email_err;?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <span class="" class="invalidalert" style="color:red;"><?php echo $password_err;?></span>
                    </div>
                    <div class="form-group loginbutton mt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="submit" class="btn myloginbtn" style="float:left;">Login</button>
                                <a href="signup.php" style="color:white;float:right;padding-top:10px;">Create Account?</a>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>