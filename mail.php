<?php
require_once 'vendor/PHPMailerAutoload.php';
$mail = new PHPMailer();

    // $mail->SMTPDebug = 4;                               // Enable verbose debug output
    $mail->IsSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'mailertest972@gmail.com';                 // SMTP username
    $mail->Password = 'test972mailer';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('mailertest972@gmail.com', 'Company Name');
    $mail->addAddress($email);     // Add a recipient
    $mail->addReplyTo('mailertest972@gmail.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Temporary Password';
    $mail->Body    = '
    <!doctype html>
    <html lang="en-US">
        <head>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
            <meta name="description" content="Reset Password Email Template.">
            <style type="text/css">
                a:hover {text-decoration: underline !important;}
            </style>
        </head>
        <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
        <!--100% body table-->
            <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
         	    style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); ">
         	    <tr>
         			<td>
         		    	<table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
         			    align="center" cellpadding="0" cellspacing="0">
         			        <tr>
         			            <td style="height:80px;">&nbsp;</td>
         			        </tr>
         			        <tr>
         			            <td style="text-align:center;">
         			                <a href="https://rakeshmandal.com" title="logo" target="_blank">
         			                    <img width="60" src="https://i.ibb.co/hL4XZp2/android-chrome-192x192.png" title="logo" alt="logo">
         			                </a>
         			            </td>
         			        </tr>
         			        <tr>
         			            <td style="height:20px;">&nbsp;</td>
         			        </tr>
         			        <tr>
         			            <td>
         			                <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
         			                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
         		                    	<tr>
         			                        <td style="height:40px;">&nbsp;</td>
         			                    </tr>
         			                    <tr>
         			                        <td style="padding:0 35px;">
         			                            <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;">Your account have been created</h1>
                                     			<span
                                     			style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                     			<h3 style="color:#455056;line-height:24px; margin:0;">
                                     			your account have been created.</h3>
                                     			<h2>
                                         			<b style="color:#455056;">Username :</b> '.$fname.' '.$lname.'
                                         			<br>
                                         			<b style="color:#455056;">Password :</b> '.$password.'
                                     			</h2>
                                     			<h3 style="color:#455056;line-height:24px; margin:0;">
                                     			<h3 style="margin-top:30px;color:#455056;">
                                     			To login, click the
                                     			following link.
                                     			</h3>
         			                            <br>
                                     			<a href="#"
                                     			style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:1px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Login
                                     			</a>
         			                        </td>
         			                    </tr>
         			                    <tr>
                             			    <td style="height:40px;">&nbsp;</td>
                             			</tr>
         			                </table>
         			            </td>
         			            <tr>
         			                <td style="height:20px;">&nbsp;</td>
         			            </tr>
         			            <tr>
         			                <td style="text-align:center;">
         			                    <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.testmailer972.com</strong></p>
         			                </td>
         			            </tr>
         			            <tr>
         			                <td style="height:80px;">&nbsp;</td>
         			            </tr>
         			        </table>
         			    </td>
         			</tr>
         		</table>
        <!--/100% body table-->
        </body>
    </html>
    ';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if(!$mail->send()) 
    {
        echo "<script>setTimeout(function() {
        $('#nomailmodal').show();
        }, 100);</script>";
        echo "<script>var div = document.getElementById('nomailtitle');
        div.innerHTML += 'Regestration Completed';</script>";
        echo "<script>var div = document.getElementById('mailmsg');
        div.innerHTML += 'mail could not be sent';</script>";
    } 
    else 
    {
        // echo 'Message has been sent';
        // echo "<script>var div = document.getElementById('mailmsg');
        // div.innerHTML += 'mail sent successfully';</script>";
        echo "<script>setTimeout(function() {
        $('#mailmodal').show();
        }, 100);</script>";
    }
    ?>