
	<nav class="navbar navbar-expand-lg navbar-dark bg-darkblue fixed-top logged-in">
        <div class="container">
            <a class="navbar-brand" href="index.php">BlueJack</a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse text-right" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="<?=url('/profile.php')?>">
                            <img class="rounded-circle avatar position-absolute" style="left:-24px" width="24" height="24" src="<?= $_SESSION['avatar'] == '' ? asset('assets/img/avatar.png') : url($_SESSION['avatar']) ?>">
                            <?=$_SESSION['fullname'] ?>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?=url('/')?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=url('/auth/auth.php?action=logout&csrf_token=' . $_SESSION['csrf_token'])?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
	</nav>
