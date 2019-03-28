<!--this file will represent one post based on the id  -->

<?php
	require('config/config.php');
	require('config/db.php');

	//check for the delete submit
	if(isset($_POST['delete'])){
		//Get form data
		$update_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

		//add a post
		$query = "DELETE FROM posts WHERE id={$update_id}";

		if(mysqli_query($conn, $query)){
			//redirect
			header('Location: '.ROOT_URL. '');
		}else{
			echo "ERROR ". mysqli_error($conn);
		}

	}


	//get the id
	$id = $_GET['id'];

	//create query
	$query = 'SELECT * FROM posts WHERE id= '.$id;

	//Get results
	$result = mysqli_query($conn , $query);

	//Fetch data; assoc takes that one post and turn it into an associative array
	$post = mysqli_fetch_assoc($result);
	// var_dump($posts);

	//free result
	mysqli_free_result($result);

	//Close connection
	mysqli_close($conn);


?>

<?php include('inc/header.php'); ?>
	<div class="container">
		<!-- loop through posts using foreach -->
				<h2><?php echo $post['title']; ?></h2>
				<small>Created on <?php echo $post['created_at']; ?>
					by <?php echo $post['author']; ?></small>
				<p><?php echo $post['body']; ?></p>

				<hr>

				<a class="btn btn-default pull-right" href="<?php echo ROOT_URL;?>editpost.php?id=<?php echo $post['id'];?>">Edit</a>

				<!-- form for delete functionality -->
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
					<input type="hidden" name="delete_id" value="<?php echo $post['id'];?>">
					<input type="submit" name="delete" value="delete" class="btn btn-danger pull-right">
				</form>

				<a class="btn btn-default" href="<?php echo ROOT_URL;?>">Go Back</a>
	</div>
<?php include('inc/footer.php');?>