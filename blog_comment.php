<?php
 //This file is included in show_blogpost.php file in the end of file. It show the comments for the post, and also present a form for users to make comments. It can't be used by itself as it uses variables declared in show_post.php file.

//Now we'll display comments and add a form to enter new comments
			echo "<h2 id='comments'>Comments</h2>";
			echo "<div class='well'>";
			//this line make a query to get comments from the database
			$comment_query = mysql_query("SELECT * FROM `blog_comments` WHERE post_id= '$post_id' AND approved") or die(mysql_error()); //it fetches approved comments for present post from database

			if (isset($_SESSION['auth'])) {
				$comment_query = mysql_query("SELECT * FROM `blog_comments` WHERE post_id= '$post_id'") or die(mysql_error()); //it fetches all comments for present post from database				
			}

			//this loop extracts all the comments from the database and print them on page
			while($row = mysql_fetch_assoc($comment_query)){
				echo "<a name='".$row['comment_id']."'></a>";
				echo "<h3>".$row['name']." said </h3>";

				//if the admin is browsing the page, this block show a delete button with comments to, well, delete the comments
				if (isset($_SESSION['auth'])) {
					echo "<a class='btn btn-danger pull-right' href='admin/delete.php?action=delete&comment_id=";

					echo $row['comment_id']."' onclick='delete();'>Delete</a>";

					if ($row['approved'] == 0) {
						echo "<a class='btn btn-info pull-right' href='admin/delete.php?action=approve&comment_id=";

						echo $row['comment_id']."' onclick='delete();'>Approve</a>";
					}
				}
				echo "<p class='comment well'>".nl2br($row['comment'])."</p>";
				//echo "<p> on ".$row['comment_time']."</p>";

			}
			
			//form to post comments

				if (! isset($_SESSION['auth']) && $_GET['moderate_msg'] == 'true') {
					echo '<div class="alert alert-info" id="alert">
					    <button type="button" class="close" data-dismiss="alert">×</button>
					    <strong>Keep Calm!</strong> Your comment is awaiting moderation.
					    </div>';
				}
		echo "<h2>Post a comment</h2>";
		echo "<div class='well'>";
		echo "<form action='post_comment.php?ID=".$post_id."' method='post' class='form-vertical'>";
		?>		<table>
					<tr>
						<td>
							<label for="commenter_name">Your Name:</label>
						</td>
					<?php if (isset($_SESSION['auth'])) {
						echo "<td style='font-color:green; font-weight:700;'>Admin</td>"; }
						else {
							echo '<td><input type=text id="cmnt_name_in" name="commenter_name" value="';
							if (isset($_SESSION['commenter_name'])) {
								echo $_SESSION['commenter_name'];
							}
							echo '"></td>';
						}
						?>
					</tr>
					<tr>
						<td>Comment</td>
						<td><textarea id="cmnt_in" name="comment"></textarea></td>
					</tr>
					<tr><td><input class='btn btn-primary' type="submit" value="Comment"></td></tr>
				</table>
			</form>
			</div>
		</div>