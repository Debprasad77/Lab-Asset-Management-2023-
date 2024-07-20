<?php

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;

    // require '../phpmailer/src/Exception.php';
    // require '../phpmailer/src/PHPMailer.php';
    // require '../phpmailer/src/SMTP.php';

    if(isset($_POST['msg_send']))
    {
        $FName = $_POST['fname'];
        $LName = $_POST['lname'];
        $Email = $_POST['email'];
        $Number = $_POST['number'];
        $MSG = $_POST['Msg'];

        if (empty($FName) || empty($LName) || empty($Email) || empty($Number) || empty($MSG) )
        {
            header('location:../Html/contact_us.php?error');
        }
        else
        {
            $to = "santanuraj75@gmail.com";
            $subject = $FName.$LName.$Number;
            $header =  $Email;

            if(mail($to,$subject,$MSG,$header))
            {
                header("location:../Html/contact_us.php?success");
            }


            // $mail = new  PHPMailer(true);

            // $mail->isSMTP();
            // $mail->Host = 'smtp.gamil.com';
            // $mail->SMTPAuth = true;
            // $mail->Username = 'santanuraj296@gmail.com';
            // $mail->Password = 'rqrrjmrvqtpfahpy';
            // $mail->SMTPSecure = 'ssl';
            // $mail->Port = 465;

            // $mail->setFrom('santanuraj296@gmail.com');

            // $mail->addAddress($header);

            // $mail->isHTML(true);

            // $mail->Subject = $subject;
            // $mail->Body = $MSG;

            // $mail->send();

            // header("location:../Html/contact_us.php?success");

        }
    }
    else
    {
        header("location:../Html/contact_us.php");
    }

?>