<?php 
require_once('helpers/session.php'); 
require_once('helpers/function.php'); 

if(isset($_SESSION['username'])){
	redirect('index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>BlueJack - Log In or Sign Up</title>
	<?php component('head'); ?>
</head>
<body class="bg-blue">
	<div id="particles-js"></div>
	<?php component('nav_unlogged'); ?>
	<div class="container h-100">
		<div class="row align-items-center h-100">
			<div class="col-4 mx-auto" style="padding: 0">
            
				<?php if(has_error()): ?>
					<div class="alert alert-danger" role="alert">
						<strong>Oops!</strong> <?=get_error()?>
					</div>
				<?php endif; ?>

				<div class="card card-block mx-auto">
  					<div class="card-body">
						<h3 class="card-title text-center">Join Us</h3>
    					<h6 class="card-subtitle mb-2 text-center text-muted">Get connected to more than a million people today!</h6>

						<form action="auth/auth.php?action=register" method="post">
							<input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
							<div class="form-group">
								<label for="name">Full Name</label>
								<input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<label for="name">Username</label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Username">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
							</div>
							<p class="text-muted text-center small">By clicking Join Now, you agree to our Terms and Privacy Policy.</p>
  							<button type="submit" class="btn btn-block btn-primary">Join Now</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php component('footer'); ?>
	<script src="<?= asset('vendor/particles/particles.min.js'); ?>"></script>
	<script>
	particlesJS.load('particles-js', '<?= asset('vendor/particles/particles.json'); ?>');
	</script>
</body>
</html>