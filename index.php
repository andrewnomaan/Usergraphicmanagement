<?php
// Database connection
 require 'db_connect.php';
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
</head>

<body id="home">

    <nav class="navbar navbar-expand-lg navbar-light py-3 fixed-top">
        <a class="navbar-brand" href="./">Graphic Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="far fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav nav-links ml-auto">
            <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <!-- showing categories on navbar -->
                <?php
                   $sql="SELECT * FROM graphics_category order by id asc";
                   $res=mysqli_query($conn,$sql);
                   while($row=mysqli_fetch_assoc($res)){
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="#<?php echo strtolower($row['category'])?>"><?php echo ucfirst($row['category'])?></a>
                </li>
                <?php
                   }
                ?>
                <li class="nav-item user-login">
                    <a class="nav-link" href="signin.php">User <i class="far fa-user"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="section-pd"></div>
    <!-- For showing categories and their graphics -->
    <?php
        $sql_cat="SELECT * FROM graphics_category order by id asc";
        $res_cat=mysqli_query($conn,$sql_cat);
        while($row=mysqli_fetch_assoc($res_cat)){
    ?>
    <section id="<?php echo strtolower($row['category'])?>" class="section-pd">
        <div class="container">
            <div class="section-title">
                <h2><?php echo ucfirst($row['category'])?></h2>
                <hr>
            </div>
            <div class="row">
            <?php
            // Query for select graphics for particular category
             $sql_graphic="SELECT * FROM graphics where cat_id='$row[id]'";
             $res_graphic=mysqli_query($conn,$sql_graphic);
             while($row_graphic=mysqli_fetch_assoc($res_graphic)){
            ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-img">
                            <img src="img/<?php echo $row_graphic['graphic']?>" alt="img-not-found" class="img">
                        </div>
                        <div class="card-body">
                            <div class="">
                                <h3 class="card-title">DIPAWALI KI HARDIK SUBHKAMNAYE!!!!</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
             }
                ?>
            </div>
        </div>
    </section>
     <?php
        }
     ?>
    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Address</h3>
                        <p>
                            Krishna Plaza, 1st Floor<br>
                            Shakti Chauk, Bijnor
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h3>Important Links</h3>
                        <ul>
                            <li>
                                <a href="#home">Home</a>
                            </li>
                            <li>
                                <a href="#fest">Fest</a>
                            </li>
                            <li>
                                <a href="#events">Events</a>
                            </li>
                            <li>
                                <a href="#thoughts">Thoughts</a>
                            </li>
                            <li>
                                <a href="#mouring">Mouring</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3>Join With Us</h3>
                        <div class="footer-icons">
                            <a href=""><i class="fab fa-facebook"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
           <div class="container py-3">
            <div class="row">
                <div class="col-md-12 text-center">
                    <span>&copy; Copyright Zoyo E-Commerce Pvt. Ltd., All Rights Reserved.</span>
                    <br>
                    <a href="https://zoyoecommerce.com/privacypolicy.php">Privacy&middot;Policy</a>
                </div>
            </div>
           </div>
        </div>
    </footer>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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