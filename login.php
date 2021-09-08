<?php session_start();?>
<?php include('head.php');?>
<link rel="stylesheet" href="popup_style.css">
<link rel="stylesheet" href="./css/stylenew.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
        <script src="https://kit.fontawesome.com/23412c6a8d.js"></script>
      
   <?php
  include('connect.php');
if(isset($_POST['btn_login']))
{
$unm = $_POST['email'];

$passw = hash('sha256', $_POST['password']);

function createSalt()
{
    return '2123293dsj2hu2nikhiljdsd';
}
$salt = createSalt();
$pass = hash('sha256', $salt . $passw);

 $sql = "SELECT * FROM admin WHERE email='" .$unm . "' and password = '". $pass."'";
    $result = mysqli_query($conn,$sql);
    $row  = mysqli_fetch_array($result);
    
     $_SESSION["id"] = $row['id'];
     $_SESSION["username"] = $row['username'];
     $_SESSION["password"] = $row['password'];
     $_SESSION["email"] = $row['email'];
     $_SESSION["fname"] = $row['fname'];
     $_SESSION["lname"] = $row['lname'];
     $_SESSION["image"] = $row['image'];
     $count=mysqli_num_rows($result);
     if($count==1 && isset($_SESSION["email"]) && isset($_SESSION["password"])) {
    {       
        ?>
         <div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p>Login Successfully</p>
    <p>
    
     <?php echo "<script>setTimeout(\"location.href = 'add_allotment.php';\",1500);</script>"; ?>
    </p>
  </div>
</div>
  
     <?php
    }
}
else {?>
     <div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p>Invalid Email or Password</p>
    <p>
      <a href="login.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
    </p>
  </div>
</div>
       
        <?php
       
         }
    
    }
?>
<?php
$sql_login = "select * from manage_website"; 
$result_login = $conn->query($sql_login);
$row_login = mysqli_fetch_array($result_login);
?>

<body>

    <div class="container">
        <div class="panel">
            <div class="row">
                <div class="col liquid">
                    <h4><i class="fas fa-drafting-compass"></i> NEC Booking System </h4>

                    <!-- Owl-Carousel -->

                    <div class="owl-carousel owl-theme">
                        <img src="./assets/undraw_authentication_fsn5.svg" alt="" class="login_img">
                        <img src="./assets/undraw_Notebook_re_id0r.svg" alt="" class="login_img">
                        <img src="./assets/undraw_two_factor_authentication_namy.svg" alt="" class="login_img">
                    </div>

                    <!-- /Owl-Carousel -->

                    <!-- <div class="follow">
                        Follow us <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-twitter"></i>
                    </div> -->
                </div>
                <div class="col login">

                    
                    <form method="POST">
                        <div class="titles">
                            <h6>Book A Venue</h6>
                            <h3>Login to Book</h3>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Email" name="email" class="form-input">
                            <div class="input-icon">
                                <!-- <i class="fas fa-user"></i> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" name="password" class="form-input">
                            <div class="input-icon">
                                <!-- <i class="fas fa-user-lock"></i> -->
                            </div>
                        </div>

                        <button type="submit" name="btn_login" class="btn btn-login">Login</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {

            $('.owl-carousel').owlCarousel({
                loop: true,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                items: 1
            });
        });
    </script>

<script src="js/custom.min.js"></script>

</body>
</body>

</html>