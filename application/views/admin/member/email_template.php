<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		.heading {
			font-family: arial;
			color: red;
		}
		p, p a {
			font-family: arial;
			font-size: 14px;
			line-height: 20px;
			letter-spacing: 0.2px;
		}
	</style>
</head>
<body>
<h1 class="heading">Reset Password</h1>
<p>To reset your password, Complete this form:</p>
<p><a href="<?php echo site_url('password/reset/' . $token); ?>">Reset your password now!</a></p>	
<p>Thank you,</p>
</body>
</html>