<?php 
    //if registration successfull then displaying an alert
    session_start();
    if(isset($_SESSION['reg_status']) && $_SESSION['reg_status']=='success'){
        echo "<script>alert('Registration Successfull. Please sign in.')</script>";
        unset($_SESSION['reg_status']);
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $email = sanatize($_POST['email']);
        $passkey = sanatize($_POST['passkey']);

        require_once('includes/config/dbconfig.php');
        try{
        $db = new PDO('mysql:hostname=' .DB_HOST. ';dbname=' .P_DB, DB_USER, DB_PASSKEY);
        
        
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //checking is email exist
            $user_count = $db->query("SELECT COUNT(*) FROM registration_details WHERE email = '$email'");
            if($user_count->fetchColumn()==0){
                echo "<script>alert('This email is not registered with us.')</script>";
            }
            
            else{
                // if email exist then getting complete profile
                $profile_data = $db->query("SELECT * FROM registration_details WHERE email = '$email'");
                $data = $profile_data->fetch(PDO::FETCH_ASSOC);
                // checking password
                if(password_verify($passkey,$data['password'])){
                    //if password matched, then starting session
                    $_SESSION['USER_LOGGED_IN'] = true;
                    $_SESSION['USER_ID'] = $data['id'];
                    $_SESSION['EMAIL'] = $data['email'];
                    
                    header("Location: index.php");
                }
                else{
                    echo "<script>alert('Entered password is not matched!');</script>";
                }
            
            }
        }

        catch(Exception $e){
            die($e->getMessage());
        }
        

    }

    //function for sanitize data
    function sanatize($data){
        $data = stripslashes($data);
        $data = trim($data);
        $data = htmlspecialchars($data);    
        return $data;
    }

?>
<!DOCTYPE html>
<html>
<head>
<title>Sign Up | Simple Login and Signup form</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="author" name="Md Farzan" />
<!-- fav icons  -->
<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="manifest" href="site.webmanifest">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css" />
</head>
<body>

<div class="container">
    <!-- form container start -->
    <div class="form-container">
        <h1>Sign in</h1>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <!-- field-container start -->
        <div class="field-container">
            <label for="email">Email: 
                <input  type="email" id="email" class="field" name="email" placeholder="example@gmail.com" required />
                
                
                <span class="error"></span>
            </label>
        </div>
        <!-- field-container end -->


        <!-- field-container start -->
        <div class="field-container">
            <label for="passkey">Password: 
                <input type="password" id="passkey" class="field" name="passkey" placeholder="Password" required />
                <span class="error"></span>
            </label>
        </div>

        
        <!-- field-container end -->

        <!-- field-container start -->
        <div class="field-container text-center">
            
                <input type="submit"  value="Sign in" />

        </div>
        <!-- field-container end -->
        </form>
        <div class="field-container text-center">
        <a href="sign-up.php" class="link text-center">Not Registered? Sign up here</a>   
        </div>
        
        <a href="password-recovery.php" class="return-link" style="color:red;">Forgot Password</a>           
    </div>
    <!-- form container end -->
    
</div>


<!-- jQuery cdn -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- js file -->
<script src="js/script.js"></script>
</body>
</html>