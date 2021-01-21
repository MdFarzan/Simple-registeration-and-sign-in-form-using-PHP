<?php 

    /*signup functionality*/
    
    $emailErr = $mobileErr = $passwordErr = "";
    
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $email = sanatize($_POST['email']);
        $mobile = sanatize($_POST['mobile-no']);
        $password = sanatize($_POST['passkey']);
    
        /*validating and sanitizing data    */

        //validating email
        if(empty($email) || preg_match('/^\s$/',$email))
            $emailErr = "This field cannot be empty";
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            $emailErr = "Enter a valid email!";
                
        //validating mobile no
        if(empty($mobile) || preg_match('/^\s$/',$mobile))
            $mobileErr = "This field cannot be empty";
        else if(!preg_match('/^[0-9]{10}$/',$mobile))
            $mobileErr = "Enter a valid mobile no.";

        // //validating password
        if(empty($password) || preg_match('/^\s$/',$password))
            $passwordErr = "This field cannot be empty";
        else if(strlen($password)<8 || strlen($password)>15)
            $passwordErr = "Password must be between 8 to 15 characters.";
            
            
            if($emailErr == "" && $mobileErr == "" && $passwordErr == ""){
                //every this is valid start here to insert in db
                //continue from here
                echo $email, $mobile, $password;
            }

            else{
                echo "<script>alert('Please solve below errors!');</script>";
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
        <h2>Register by filling this form</h2>
        <form action="<?php  htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <!-- field-container start -->
        <div class="field-container">
            <label for="email">Email: 
                <input  type="email" id="email" class="field" name="email" placeholder="example@gmail.com" required />
                
                
                <span class="error"><?php echo $emailErr; ?></span>
            </label>
        </div>
        <!-- field-container end -->

        <!-- field-container start -->
        <div class="field-container">
            <label for="mobile-no">Mobile No.:
                <input type="tel" id="mobile-no" class="field" name="mobile-no" placeholder="10 digit" required />
                <span class="error"><?php echo $mobileErr; ?></span>
            </label>
        </div>
        <!-- field-container end -->

        <!-- field-container start -->
        <div class="field-container">
            <label for="passkey">Password: 
                <input type="password" id="passkey" class="field" name="passkey" placeholder="Password" required />
                <span class="error"><?php echo $passwordErr; ?></span>
            </label>
        </div>

        
        <!-- field-container end -->

        <!-- field-container start -->
        <div class="field-container text-center">
            
                <input type="submit"  value="Register" />

        </div>
        <!-- field-container end -->
        </form>
        <a href="index.php" class="return-link"><i class="fas fa-arrow-left"></i> Back to Sign in</a>   
        
               
    </div>
    <!-- form container end -->
    
</div>


<!-- jQuery cdn -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<!-- js file -->
<script src="js/script.js"></script>
</body>
</html>