<?php
include './header.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../Css/contact_us.css">
</head>

<body>
    <div class="page_body">
        <div class="contactUs">
        </div>
        <div class="box">
            <!--Form-->
            <div class="contact form">
                <h3>Send a Message</h3>

                <?php
                
                    $Msg="";

                    if(isset($_GET['error']))
                    {
                        $Msg = "Please Fill in the Blanks.";
                        echo '<div>'.$Msg.'</div>';

                    }

                    if(isset($_GET['success']))
                    {
                        $Msg = "Your  Message Has Been Sent";
                        echo '<div>'.$Msg.'</div>';
                    }


                ?>
                <form action="../php/Contact_us_.php" method="post">
                    <div class="formBox">
                        <div class="row50">
                            <div class="inputBox">
                                <span>First Name</span>
                                <input type="text" placeholder="Enter your First Name" name="fname">
                            </div>
                            <div class="inputBox">
                                <span>Last Name</span>
                                <input type="text" placeholder="Enter your Last Name" name="lname">
                            </div>
                        </div>

                        <div class="row50">
                            <div class="inputBox">
                                <span>Email Address</span>
                                <input type="text" placeholder="---@gmail.com" name="email">
                            </div>
                            <div class="inputBox">
                                <span>Mobile</span>
                                <input type="text" placeholder="+91----------" name="number">
                            </div>
                        </div>

                        <div class="row100">
                            <div class="inputBox">
                                <span>Message</span>
                                <textarea placeholder="Write your message here..." name="Msg"></textarea>
                            </div>
                        </div>

                        <div class="row100">
                            <div class="inputBox">
                                <input type="submit" value="Send" name="msg_send">
                                <!-- <button class="inputBox" type="submit" name="msg_send">send</button> -->
                            </div>
                        </div>



                    </div>
                </form>
            </div>

            <!--Info Box-->
            <div class="contact info">
                <h3>Contact Info</h3>
                <div class="infoBox">
                    <div>
                        <span>
                            <ion-icon name="location"></ion-icon>
                        </span>
                        <p>Netaji Nagar,Kolkata</p>
                    </div>
                    <div>
                        <span>
                            <ion-icon name="mail"></ion-icon>
                        </span>
                        <a href="mailto:rohandewan72@gmail.com">rohandewan72@gmail.com</a>
                    </div>
                    <div>
                        <span>
                            <ion-icon name="call"></ion-icon>
                        </span>
                        <a href="tel:7439432447">+91 7439432447</a>
                    </div>
                    <!--Social Media Link-->
                    <ul class="sci">
                        <li><a href="#">
                                <ion-icon name="logo-facebook"></ion-icon>
                            </a></li>
                        <li><a href="#">
                                <ion-icon name="logo-twitter"></ion-icon>
                            </a></li>
                        <li><a href="#">
                                <ion-icon name="logo-linkedin"></ion-icon>
                            </a></li>
                        <li><a href="#">
                                <ion-icon name="logo-instagram"></ion-icon>
                            </a></li>
                    </ul>
                </div>
            </div>

            <!--Map Box-->
            <div class="contact map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3686.6603862400752!2d88.35764411490912!3d22.479393085230793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0270fcdb684cb9%3A0x59895bee993e675b!2s7%2C%209%2F38%2C%20Netaji%20Nagar%2C%20Kolkata%2C%20West%20Bengal%20700040!5e0!3m2!1sen!2sin!4v1666099460086!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </div>
</body>

</html>