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
			<div class="col-md-3 px-2">
				<div class="card my-2">
				
					<svg class="bd-placeholder-img" width="100%" height="100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
						<rect fill="#1b93d1" width="100%" height="100%"></rect>
					</svg>

					<div class="card-body text-center">
						<a class="block link-no-decor" href="#"> 
							<h5 class="card-title mb-0 text-truncate"> <?=$_SESSION['fullname']?> </h5>
						</a>
						<p class="card-text">@<?=$_SESSION['username']?></p>
					</div>
					
					<div class="card-body border-top">
						<?php

						$count_query = "SELECT p.post, c.comment FROM 
											(SELECT COUNT(`id`) AS post FROM `posts` WHERE `user_id` = $_SESSION[id]) p,
											(SELECT COUNT(`id`) AS comment FROM `comments` WHERE `user_id` = $_SESSION[id]) c";
						$count = $connection->query($count_query)->fetch_object();

						?>
						Posts: <?=$count->post?><br/>
						Comment: <?=$count->comment?>
					</div>
				</div>
			</div>
			<div class="col-md-6 px-2">
				<div class="card my-2">
					<form action="post/add.php" method="post">
						<input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token']?>">
						<div class="card-body text-center">
							<textarea class="form-control form-control-lg" type="text" placeholder="Good Day!" name="content" required></textarea>
							<div class="text-right pt-2">
  								<button type="submit" class="btn btn-primary px-5">Post</button>
							</div>
						</div>
					</form>
				</div>

				<?php

				$fetch_posts = "SELECT p.id, p.content, p.created_at, u.fullname, u.username, u.avatar
						  FROM `posts` p
							  JOIN `users` u ON p.user_id = u.id
						  ORDER BY p.created_at DESC";
				
				$posts = $connection->query($fetch_posts);

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

			<div class="col-md-3 px-2">
				<div class="card my-2">
					<div class="card-body">
						<h5 class="card-title mb-0">Notification</h5>
					</div>
					<ul class="list-group list-group-flush">
						<?php 
						$fetch_comments_to_user = "SELECT c.`id`, c.`created_at`, u.`fullname`, u.`username`, c.`post_id`
													FROM `comments` c
														JOIN `users` u ON c.`user_id` = u.`id`
													WHERE c.`user_id` != $_SESSION[id]
														AND c.`post_id` IN (
															SELECT `id` 
															FROM `posts`
															WHERE `user_id` = $_SESSION[id]
														)
													ORDER BY c.`created_at` DESC";

						$notifications = $connection->query($fetch_comments_to_user);

						while($notification = $notifications->fetch_object()):
							$created_at = strtotime($notification->created_at);
						?>
							<li class="list-group-item">
								<strong><?=$notification->fullname?></strong> commented on your <a href="<?=url("post.php?id=$notification->post_id")?>" class="text-info">post</a>. 
								<span class="text-muted"><?=date("d M Y H:i", $created_at)?></span>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
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