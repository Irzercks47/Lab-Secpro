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
	<title>BlueJack - Log In</title>
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

                <?php if(has_success()): ?>
                    <div class="alert alert-success" role="alert">
                        <strong>Success!</strong> <?=get_success()?>
                    </div>
                <?php endif; ?>

				<div class="card card-block mx-auto">
  					<div class="card-body">
						<h3 class="card-title text-center">Login</h3>

						<form action="auth/auth.php?action=login" method="post">
							<input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
							<div class="form-group">
								<label for="name">Email or Username</label>
								<input type="text" class="form-control" id="username" name="username" placeholder="Email or Username">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
							</div>
  							<button type="submit" class="btn btn-block btn-primary">Login</button>
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