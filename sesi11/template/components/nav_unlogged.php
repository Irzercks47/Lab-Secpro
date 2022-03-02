
	<nav class="navbar navbar-dark fixed-top" style="background-color: rgba(0, 0, 0, 0.1);">
		<span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
		<a class="navbar-brand" href="index.php">BlueJack</a>
		
		<form class="form-inline" action="auth/auth.php?action=login" method="post">
			<input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
			<input class="form-control mr-sm-2" type="text" name="username" placeholder="Email or Username" aria-label="Email">
			<input class="form-control mr-sm-2" type="password" name="password" placeholder="Password" aria-label="Password">
			<button class="btn btn-primary my-2 my-sm-0" type="submit">Sign In</button>
		</form>
	</nav>