<?php include_once 'assets/includes/_header.php'; ?>

<!-- THIS IS THE HOME PAGE -->
	<div id="post_list"  >
		
					
	<!-- HERE STARTS THE SLIDESHOW CODE -->
			<div id="myCarousel" class="carousel slide">
				<div class="carousel-inner">
					<div class="item">
						<img src="assets/img/img1.jpg" alt="">
						<div class="carousel-caption">
							<h4>We are just awesome</h4>
							<p></p>
						</div>
					</div>
					<div class="item">
						<img src="assets/img/img2.jpg" alt="">
						<div class="carousel-caption">
							<h4>You can't beat Us!</h4>
							<p></p>
						</div>
					</div>
					<div class="item active">
						<img src="assets/img/img3.jpg" height=272px alt="">
						<div class="carousel-caption">
							<h4>Feel free to try</h4>
							<p></p>
						</div>
					</div>
				</div>
				<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
			</div>
			<!-- SLIDESHOW CODE ENDS -->

			<!-- NOTIFICATIONS -->
			<?php if (isset($_SESSION['auth'])) { ?>

				<?php 
					$notifications = mysql_num_rows(mysql_query("SELECT * FROM blog_comments WHERE approved=0"));

					if ($notifications >= 1) {
						echo '<div class="span3" id="notifications" onclick="location.href=\'admin/notifications.php\'">';
						echo "<img class='pull-left' src='http://cdn1.iconfinder.com/data/icons/facebook/notifications.png' />";
						echo "<h5>Notification</h5>";

						if ($notifications == 1) {
							echo "$notifications comment need moderation";
						}
						else echo "$notifications comments need moderation";
					?>
					</div>	

					<div id="notification-dropdown">
						<p onclick=(location.href="admin/notifications.php")>
							<i class="icon-flag icon-white"></i>
							<?php echo $notifications;
							if ($notifications > 1) echo " Notifications";
							else echo " Notification";
						 ?></p>

					</div>

				<?php
					}
				 ?>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						$('#notifications').fadeIn(1800).delay(2000).fadeOut(1800, function(){
							$('#notification-dropdown').slideDown('slow');
						});
					});
					
				</script>	
			<?php } ?>
			<!-- NOTIFICATIONS END -->
			
		<?php 
			$post_query = mysql_query("SELECT * FROM `blog_posts` ORDER BY id DESC LIMIT 10")  or die(error_message("Cannot Connect fetch data from database."));  //this function make query to database, or print error

			$author = "Admin";
			while ($post = mysql_fetch_assoc($post_query)) {
					echo "<div class='post well'>";
					echo "<h1><a href='show_blogpost.php?ID=".$post['id']."'>".$post['title']."</a></h1>";
					echo "<p>".substr(($post['post']), 0, 450)."<b>...</b></p>";
					echo "<p><a href='show_blogpost.php?ID=".$post['id']."'> Read More</a><br>";
					echo "<span class='footer'>Posted By: ".$author."  &#9618; Last Updated: ".$post['date_posted']."  &#9618; "; //." Tags: ". $post->tags
					echo '<span class="btn" id="counter">'.$post['likes'].' likes</span>';
					echo "</span><br><br><br></div>";
			}
			echo "</div";
			// include_once 'assets/includes/_footer.php';
 		?>
 	</div>