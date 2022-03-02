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
	<title>BlueJack - Home</title>
	<?php component('head'); ?>
</head>
<body>
	<?php component('nav'); ?>

	<div class="container">
		<div class="row py-2">
			<div class="col-md-3 px-2"></div>
			<div class="col-md-6 px-2">
				<?php
				$fetch_posts = "SELECT p.id, p.content, p.created_at, u.fullname, u.username, u.avatar
                                FROM `posts` p
                                    JOIN `users` u ON p.user_id = u.id
                                WHERE `p`.`id` = ?";
				$stmt = $connection->prepare($fetch_posts);
				$stmt->bind_param("i", $_GET['id']);
				$stmt->execute();
				$posts = $stmt->get_result();
				$stmt->close();

				while($post = $posts->fetch_object()):
					$created_at = strtotime($post->created_at);

					$fetch_comment = "SELECT c.content, c.created_at, u.fullname, u.username, u.avatar
									FROM `comments` c
										JOIN `users` u ON u.id = c.user_id
									WHERE `post_id` = $post->id
									ORDER BY c.created_at ASC";
					$comments = $connection->query($fetch_comment);
				?>
					<div id="post-<?=$post->id?>" class="card my-2 post">
						<div class="card-body">
							<div class="row mx-0">
								<div>
									<img class="rounded-circle avatar" width="40" height="40" src="<?= $post->avatar == '' ? asset('assets/img/avatar.png') : url($post->avatar) ?>">
								</div>
								<div class="ml-2">
									<h5 class="card-title mb-0 text-truncate"> <?=$post->fullname?> </h5>
									<p class="small mb-2"><a class="text-muted" href="<?=url("/post.php?id=$post->id")?>"><?=date("d M Y H:i", $created_at)?></a></p>
								</div>
							</div>
							<p class="card-text"><?=nl2br(htmlspecialchars($post->content, ENT_QUOTES, 'UTF-8'))?></p>
						</div>
						<div class="card-footer">
							<div class="comments">
								<?php while($comment = $comments->fetch_object()): 
										$comment_time = strtotime($comment->created_at);
									?> 
									<div class="row comment">
										<div class="col-1">
											<img class="rounded-circle avatar" width="32" height="32" src="<?= $comment->avatar == '' ? asset('assets/img/avatar.png') : url($comment->avatar) ?>">
										</div>
										<div class="col-11">
											<strong><?=$comment->fullname?></strong> <?=htmlspecialchars($comment->content, ENT_QUOTES, 'UTF-8')?>
											<span class="small mb-2 text-muted"><?=date("d M Y H:i", $comment_time)?></p>
										</div>
									</div>
								<?php endwhile; ?>
							</div>

							<div class="row">
								<div class="col-1 pt-1">
									<img class="rounded-circle avatar" width="32" height="32" src="<?= $_SESSION['avatar'] == '' ? asset('assets/img/avatar.png') : url($_SESSION['avatar']) ?>">
								</div>
								<div class="col-11">
									<form class="form-comment" action="comment/add.php" method="post">
										<input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
										<input type="hidden" name="post_id" value="<?=$post->id?>">
										<input type="text" name="content" placeholder="Write a comment..." class="form-control" required>
										<input type="submit" 
											style="position: absolute; left: -9999px; width: 1px; height: 1px;"
											tabindex="-1" />
									</form>
								</div>
							</div>
						</div>
					</div>

				<?php endwhile; ?>

			</div>

			<div class="col-md-3 px-2"></div>
		</div>
	</div>

	<?php component('footer'); ?>
	<script>
		$(function(){
			$(".form-comment").submit(function(e){
				e.preventDefault();

				$.ajax({
					url: 'comment/add.php',
					type: 'post',
					data: $(this).serialize(),
					dataType: "json",
					success: function(data){
						if(data.success == true){
							let post_div = $("#post-" + data.post_id +" .comments");
							console.log(post_div);
							let comment_div = '<div class="row comment">'
										+ '<div class="col-1"> '
										+ '	<img class="rounded-circle avatar" width="32" height="32" src="<?= $_SESSION['avatar'] == '' ? asset('assets/img/avatar.png') : url($_SESSION['avatar']) ?>">'
										+ '</div>'
										+ '<div class="col-11">'
										+ '	<strong><?=$_SESSION['fullname']?></strong> ' + data.comment
										+ ' <span class="small mb-2 text-muted"> ' + data.created_at + '</p> '
										+ '</div>'
									+ '</div>';
							post_div.append(comment_div);
							$("#post-" + data.post_id + " form").trigger('reset');
						}
					}
				});
			});
		});
	</script>
</body>
</html>