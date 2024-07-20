<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forget_Password2</title>
    <link rel="stylesheet" href="../Css/forget2.css">
</head>
<body>
    <div class="sign-up-form">
        <div class="img">
            <img src="../Img/imgg.png" alt="">
        </div>
        <h1>Enter One-time password</h1>
        <h1 id="otp">Hey, We have send you your One-time password check your email</h1>
        <h1 id="otp">**DO NOT SHARE YOUR OPT**</h1>
        <!-- kalyan -->
        <form action="../php/_otpcheck.php" method="POST">
            <input type="number" name="otp" class="input-box" placeholder="Enter 6 digit OTP" required>
            <div>
                <h5><span id="time"></span></h5>
            <!-- </div><p id="agree"><span><input type="checkbox" class="check"></span> Agree to the Terms of services</p><div> -->
                <a href="#"><button type="submit" class="sub-btn">Submit</button></a>
                <a ><button class="Re-send" onclick="location.href='../php/_mail.php';" >Re-send OTP</button></a>
            </div>
        </form>
        <hr>
        <p class="wrong1">Entered wrong email ?</p>
        <p class="wrong">Do not worry, click below to enter your correct email</p>
        <a href="./forget1.html"><button class="Wrong-Email">Enter email</button></a>
        <p class="contact">Having trouble? feel free to <a href="#">Contact Us</a></p>
        <p class="contact">Didn't request a password? You can ignore this message</p>
    </div>

    <!-- this php part is chacking that is the page redirected from _otpcheck.php page or not. -->
    <?php
    include("../php/config.php");

    // echo $_SESSION['key'];
    if(isset($_SESSION['key']) && $_SESSION['key'] == "false"){
        unset($_SESSION["key"]);
        echo "
        <script>
            document.getElementById('time').innerHTML='OTP Expire';
        </script>";
        die;
    }
    ?>
    <script>
    var min = 1;
    var sec = 60;
    
    var time = setInterval(function(){
        if(min == 0 && sec == 1){
            document.getElementById("time").innerHTML="OTP Expire";
            clearInterval(time);

            alert("OTP timeout.\nHit \"Re-send OTP\" button to generate new OTP");
        }else{
            sec--;
            if(sec == 0){
                min--;
                sec = 60;

                if(min == 0){
                    min = min;
                }
            }
            document.getElementById("time").innerHTML ="OTP valid till " + min + ":" + sec;
        }
    }, 1000);
</script>

</body>
</html>