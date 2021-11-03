<?php
//   Db connection
  include 'db_connect.php';
//   validate function files
  include 'function.php';
//   variable declaration for showing error 
  $email_err="";
  $name_err="";
  $email="";
  $name="";
  $password_err="";
  $repeat_password_err="";
  $name="";
  $email="";
  $er=0;
  if(isset($_POST['submit'])){
      $name=mysqli_real_escape_string($conn,$_POST['name']);
      $email=mysqli_real_escape_string($conn,$_POST['email']);
      $password=mysqli_real_escape_string($conn,$_POST['password']);
      $repeat_password=mysqli_real_escape_string($conn,$_POST['repeat_password']);
      if($name==""){
          $name_err="Plz enter your name";
          $er++;
      }
      else if(!preg_match("/^[a-zA-Z ]*$/",$name)){
        $name_err = "*Only letters and white space allowed";
        $er++;
    }
      if($email==""){
          $email_err="Plz enter your email";
          $er++;
      }
      else  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $er++;
      }
      if($password==""){
          $password_err="Plz enter your password";
          $er++;
      }
      else if(strlen($password)<8){
        $password_err="Your Password Must Contain At Least 8 Characters ";
        $er++;
      }
      if($repeat_password==""){
          $repeat_password_err="*Repeat your password";
          $er++;
      }
      else if($repeat_password!=$password){
        $repeat_password_err = "Your password and repeat password is not matching";
        $er++;   
      }
      if($er==0){
       $email_err="";
       $password_err="";
       $name_err="";
       $repeat_password_err="";
       $sql1="SELECT * FROM users where email='$email'";
       $res1=mysqli_query($conn,$sql1);
       $row1=mysqli_fetch_assoc($res1);
       if(mysqli_num_rows($res1)>0){
        //    if email registered but not verify
           if($row1['status']==0){
            $email_err="This email is already registered with us check your email to verify your account";
           }
        //    if email already exist
           else{
            $email_err="Email id already exist";
           }
       }
       else{
        //    token for email verification link
        $token = md5($_POST['email']).rand(1000,9999);   
       $hash=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT into users values('','$name','$email','$hash','$token',0)";
        $result=mysqli_query($conn,$sql);
        require_once("PHPMailerAutoload.php");
         $mail = new PHPMailer();   
         $mail->isSMTP();
         $mail->CharSet='UTF-8'; 
         $mail->Host = 'smtp.mailtrap.io';
         $mail->SMTPAuth = true;
         $mail->Username = '9045fb596a6e43';
         $mail->Password = '6ac5ee4ce624b5';
         $mail->SMTPSecure = 'tls';
         $mail->Port = 2525;

         $mail->setFrom('andrew.nomaan@gmail.com');

         $mail->isHTML(true);

        $mail->Subject = "Email verification link from Zoyo ecommerce";
        // Sending link to user for verify 
        $mail->Body = '<a href="http://localhost/graphicmanagement/verify_email.php?key='.$_POST['email'].'&token='.$token.'">Click Hereto verify your email for graphic management</a>';
         $mail->AddAddress($email);
        if($mail->send()){
            ?>
              <script>
                //   if email send successfully then we will moved to email.php
                  window.location="email.php";
              </script>
            <?php
        }    

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Zoyo Login</title>
    <link rel="stylesheet" href="css/loginstyle.css">
</head>

<body>
    <div class="container loginform">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="aduraloginhead py-3">
                    <h2>Zoyo SignUp</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="loginformdiv">
                    <form action="" name="signupform" method="POST">
                        <div class="form-group">
                            <span class="" class="invalidalert" style="color:red;"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                                value="<?php echo $name; ?>">
                            <span class="" class="invalidalert" style="color:red;"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label for="email">User Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                                value="<?php echo $email; ?>">
                            <span class="" class="invalidalert" style="color:red;"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <span class=""></span>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password">
                            <span class="" class="invalidalert" style="color:red;"><?php echo $password_err;?></span>
                        </div>
                        <div class="form-group">
                            <label for="repeatpassword">Repeat Password</label>
                            <span class="error" id="error"></span>
                            <input type="password" class="form-control" name="repeat_password" id="repeatpassword"
                                placeholder="Password">
                            <span class="" class="invalidalert"
                                style="color:red;"><?php echo $repeat_password_err;?></span>
                        </div>
                        <div class="form-group loginbutton mt-4">
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn myloginbtn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>