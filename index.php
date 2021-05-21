<?php

require_once("app/core/Database.php");
$errors=[
    "emailError"=>'',
    "termError"=>''
];
$success=false;
$db=new Database();
if(isset($_POST['save'])){
    $email=$_POST['email'];
    $terms='';
    if(isset($_POST['terms'])){ $terms=$_POST['terms'];}
    if(checkIfemailIsValid($email) && !checkIfemailComesFromColombia($email) && $terms=='on'){
       $db->execSQL("INSERT INTO `emails`(email, date) VALUES ("."'".$email."'".",CURRENT_DATE)");
       $success=true;
    }
    else{
        if(strlen($email)==0){
            $errors["emailError"]='Email address is required';
        }
        else if(!checkIfemailIsValid($email)){
            $errors["emailError"]='Please provide a valid e-mail address';
        }
        else{
            $errors["emailError"]='We are not accepting subscriptions from Colombia emails';  
        }
    
        if($terms!='on'){
            $errors["termError"]='You must accept the terms and conditions';
        }
    }
}

function checkIfemailIsValid($email){
    $reg= "/\S+@\S+\.\S+/";
    return preg_match($reg, $email);
}

function checkIfemailComesFromColombia($email){
    $reg= "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.+-]+\.co$/";
    return preg_match($reg, $email);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="row" style="min-height: 100vh;">
        <div class="col-30 white-gradient">
            <div class="navbar">
                <span>
                    <img class="logo-image" src="./images/Union.png" alt="">
                    <span class="name" style="font-family: arial;">pineaple</span>
                </span>
                <a class="active" href="#"></a>
                <a href="#">Contact</a>
                <a href="#">How it works</a>
                <a href="#">About</a>
            </div>
            <?php if($success!=true) : ?>
                <form name="submitingEmail" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST" onsubmit="return validateForm();">
                    <div class="main">
                        <h1 class="heading">
                            Subscribe to newsletter
                        </h1>
                        <p class="content">
                            Subscribe to our newsletter and get 10% discount on<br> pineaple glasses
                        </p>

                        <div class="input-box" style="width: 100%;position:relative;margin-bottom: 150px;">
                            <div class="input-container" style="position: absolute;margin-left:80px">
                                <input name="email" class="input-field" type="text" placeholder="Type your email address here...">
                                <button name="save" type="submit" style="all:unset"><i class="fas fa-long-arrow-alt-right icon"
                                        style="cursor: pointer;"></i></button>

                            </div>
                        </div>
                        <p id="emailError" style="margin-left: 8vw; color:red">
                        <?php
                                echo $errors["emailError"];
                        ?>
                        </p>
                        <div>
                            <div class="cbox-container" style="margin:0 20% 0 20%;border-bottom:1px solid #E3E3E4">
                                <label class="container" style="padding-bottom: 30px;">I agree to <u>terms of service </u>
                                    <input name="terms" type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <p id="termError" style="color:red">
                                    <?php
                                        echo $errors["termError"];
                                    ?>
                                </p>
                            </div>
                        </div>
                        </form>
                        <div class="row icons" style="width: 50%; margin: auto; padding-bottom: 10%;">
                            <div class="col">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                            </div>
                            <div class="col">
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                            <div class="col">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                            </div>
                            <div class="col">
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                
            <?php else :?>
                <div class="main">
                    <div>
                    <img class="success-img" src="images/success.png" alt="">
                        <h1 class="success-heding">
                            Thanks for subscribing!
                        </h1>
                        
                        <p class="success-content">
                            You have successfully subscribed to our email listing.<br> Check your email for the discount code.
                        </p>
                    </div>
                        
                    <div class="row icons" style="width: 50%; margin: auto; padding-bottom: 10%;">
                        <div class="col">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </div>
                        <div class="col">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="col">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                        <div class="col">
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
        <div class="col-70 ">
            <div style="height: 100%; width: 100%;" class="pineaple">

            </div>

        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/main.js"></script>
</body>

</html>