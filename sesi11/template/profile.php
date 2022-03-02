<?php 
require_once('helpers/session.php'); 
require_once('helpers/function.php'); 
require_once('controller/connection.php'); 

if(!isset($_SESSION['username'])){
	redirect('index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>BlueJack - Edit Profile</title>
	<?php component('head'); ?>
</head>
<body>
	<?php component('nav'); ?>

	<div class="container">
		<div class="row py-2">
			<div class="col-md-12 px-2">
				<div class="card">
                
					<div class="card-body">                        
                        <div class="row">
                            <div class="col-md-4">
                                <form action="profile/avatar.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
                                    <div class="avatar-upload text-center pt-3">

                                        <label for="avatarfile">
                                            <div class="circle-img img-thumbnail rounded-circle" style="height:150px; width: 150px; overflow: hidden; padding: 0">
                                                <img id="img-avatar" class="img-responsive" style="cursor: pointer; height:100%; width:100%" src="<?= $_SESSION['avatar'] == '' ? asset('assets/img/avatar.png') : url($_SESSION['avatar']) ?>">
                                            </div>
                                        </label>
                                        <input type="file" name="avatarfile" size="20" multiple="" id="avatarfile"/>
                                        <p class="text-mute mb-0">Click To Change Avatar</p>
                                        <p><small class="text-mute">gif, png, jpg, jpeg only</small></p>

                                        <button type="submit" id="btn-avatar" class="mt-2 btn btn-primary" disabled>Save Avatar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8">
                                <form action="profile/update.php" method="post">
                                    <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">

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

                                    <div class="form-group row">
                                        <label for="fullname" class="col-md-4 col-form-label">Name</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Name" value="<?=$_SESSION['fullname']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label">Email</label>
                                        <div class="col-md-8">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?=$_SESSION['email']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label">Current Password</label>
                                        <div class="col-md-8">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Current Password">
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group row">
                                        <label for="newpassword" class="col-md-4 col-form-label">New Password</label>
                                        <div class="col-md-8">
                                            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password">
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                Only fill this field when you want to change your password 
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newpasswordconfirm" class="col-md-4 col-form-label">Confirm New Password</label>
                                        <div class="col-md-8">
                                            <input type="password" class="form-control" id="newpasswordconfirm" name="newpasswordconfirm" placeholder="Confirm New Password">
                                        </div>
                                    </div>
                                    <div class="text-right pt-2">
                                        <button type="submit" class="btn btn-primary px-5">Save</button>
							        </div>
                                </form>
                            </div>
                        </div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<?php component('footer'); ?>
    <script>

    $(function(){
        var lastValidImage = "";

        $("#avatarfile").change(function(){
            let url = $(this).val();
            let ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if(this.files && this.files[0]){
                if(ext == 'gif' || ext == 'png' || ext == 'jpg' || ext == 'jpeg'){
                    $("#btn-avatar").removeAttr('disabled');
                    
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img-avatar').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                    lastValidImage = this.files[0];
                }
                else{
                    alert("Selected file is not valid");
                    $("#btn-avatar").attr('disabled', 'disabled');
                }
            }
            else{
                $("#btn-avatar").attr('disabled', 'disabled');
            }
        });
    });

    </script>
</body>
</html>