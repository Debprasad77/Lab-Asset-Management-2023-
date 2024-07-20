<?php
include('../php/config.php');
if (isset($_SESSION['login_status']) && $_SESSION['login_status'] == true) {
	header('Location:Home.php');
	exit;
}
if (isset($_COOKIE['login_token']) && $_COOKIE['login_token']) {

	$remember_token = $_COOKIE['login_token'];

	$qur = "SELECT * FROM `login` WHERE login_token='$remember_token'";
	$qur_ran = mysqli_query($conn, $qur) or die(mysqli_error($conn));

	$no = mysqli_num_rows($qur_ran);

	if ($no) {
		$row = mysqli_fetch_array($qur_ran);
		$email = $row['email'];
		$date = date('Y-m-d H:i:s');
        $token = md5(rand(0, 9999));
		$_SESSION['login_status']=true;
		$_SESSION['login_token']=$token;
		$_SESSION['user_id'] = $row['id'];
		$sql = "UPDATE `login` SET 
		login_token='$token', 
		login_date ='$date' 
		WHERE email='$email'";
        $qrr = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		header('Location:Home.php');
		exit;
	}
}
// }
// AfterLogin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>login</title>
	<link rel="stylesheet" href="../Css/index.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<!-- partial:index.partial.html -->
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form id="sign_up">
				<h1>Create Account</h1>
				<div class="social-container">
					<a href="#" class="facebook"><i class="fa fa-facebook-f"></i></a>
					<a href="#" class="google"><i class="fa fa-google-plus"></i></a>
				</div>
				<span>or use your email for registration</span>
				<input type="text" name="register_name" id="register_name" placeholder="Name" required />
				<span class="red" id="err_name"></span>
				<input type="email" name="register_email" id="register_email" placeholder="Email" required />
				<span class="red" id="err_email"></span>
				<input type="password" name="register_password" id="register_password" placeholder="Password" required />
				<span class="red" id="err_pass"></span>
				<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required />
				<span class="red" id="err_con_pass"></span>
				<button type="submit" id="Sign_Up">Sign Up</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form id="login">
				<h1>Sign in</h1>
				<div class="social-container">
					<a href="#" class="facebook"><i class="fa fa-facebook-f"></i></a>
					<a href="#" class="google"><i class="fa fa-google-plus"></i></a>
				</div>
				<span>or use your account</span>
				<input type="email" name="login_email" id="login_email" placeholder="Email" required />
				<span class="red" id="err_login_email"></span>
				<input type="password" name="login_password" placeholder="Password" required />
				<span class="red" id="err_login_pass"></span>

				<div class="forgot_pass">
					<a href="./forget1.html">Forgot your password?</a>

				</div>
				<button id="Sign_In" type="submit">Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<!-- <h1>DAITM</h1>
					<p>Dinbandhu Andrews Institute Of Technology & Management</p> -->
					<h1>Welcome Back!</h1>
					<p>To keep connected with us please login with your personal info</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<!-- <h1>Welcome Back!</h1>
					<p>To keep connected with us please login with your personal info</p> -->
					<h1>DAITM</h1>
					<p>Dinbandhu Andrews Institute Of Technology & Management</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>

	<footer>
		<p>
			Welcome to the lab managements system
		</p>
	</footer>
	<!-- partial -->
	<script src="../js/index.js"></script>

</body>

</html>

<script src="../js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
	function IsEmail(email) {
		var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!regex.test(email)) {
			return false;
		} else {
			return true;
		}
	}



	$(document).ready(function() {

		// name checked
		$('#register_name').blur(function(e) {
			e.preventDefault()
			var name = $('#register_name').val();
			if (name == '') {
				$("#err_name").html("Please enter name")
			} else {
				$("#err_name").html("")
			}


		})



		$('#register_email').blur(function(e) {
			e.preventDefault()
			var email = $('#register_email').val();
			if (email == '') {
				$("#err_email").html("Please enter email")
			} else {
				$("#err_email").html("")
			}


		})



		$('#register_email').blur(function(e) {
			e.preventDefault()
			var email = $('#register_email').val();
			if (IsEmail(email) == false) {

				$("#err_email").html("Please enter valid email")
			} else {
				$("#err_email").html("")
			}


		})


		$("#register_password").blur(function(e) {
			e.preventDefault()
			var pass = $('#register_password').val();
			if (pass == '') {
				$("#err_pass").html("Please enter password")
			} else {
				$("#err_pass").html("")
			}


		})

		$("#confirm_password").blur(function(e) {
			e.preventDefault()
			var conf_pass = $("#confirm_password").val();
			if (conf_pass == '') {

				$("#err_con_pass").html("Please enter confirm password")
			} else {
				$("#err_con_pass").html("")
			}


		})

		$('#confirm_password').blur(function(e) {
			e.preventDefault()
			var conf_pass = $('#confirm_password').val();
			var pass = $('#register_password').val();
			if (conf_pass !== pass) {

				$("#err_con_pass").html("Password not match")
			} else {
				$("#err_con_pass").html("")
			}


		})

	})



	// sign_up check using ajax
	$(document).ready(function() {
		$("#sign_up").submit(function(e) {
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: "../php/register.php",
				data: $('#sign_up').serialize(),
				dataType: 'json',
				success: function(data) {
					if (data.code == 1) {
						swal(data.massage, {
							icon: "success",
						}).then((val) => {
							window.location = data.redirect;

						})

					} else {
						swal(data.massage, {
							icon: "error",
						});


					}
				}

			})
		})
	})

	//login check using ajax

	$(document).ready(function() {
		$('#login_email').blur(function(e) {
			e.preventDefault()
			var email = $('#login_email').val();
			if (email == '') {
				$("#err_login_email").html("Please enter email")
			} else {
				$("#err_login_email").html("")
			}


		})



		$('#login_email').blur(function(e) {
			e.preventDefault()
			var email = $('#login_email').val();
			if (IsEmail(email) == false) {

				$("#err_login_email").html("Please enter valid email")
			} else {
				$("#err_login_email").html("")
			}


		})


		$("#login_password").blur(function(e) {
			e.preventDefault()
			var pass = $('#login_password').val();
			if (pass == '') {
				$("#err_login_pass").html("Please enter password")
			} else {
				$("#err_login_pass").html("")
			}


		})
	})

	$(document).ready(function() {
		$("#login").submit(function(e) {
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: "../php/login.php",
				data: $('#login').serialize(),
				dataType: 'json',
				success: function(data) {
					if (data.code == 1) {
						swal(data.massage, {
							icon: "success",
						}).then((val) => {
							window.location = data.redirect;

						})

					} else {
						swal(data.massage, {
							icon: "error",
						});


					}
				}

			})
		})
	})
</script>