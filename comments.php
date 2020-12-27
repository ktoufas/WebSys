<!DOCTYPE html>
<html lang = "el">
	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="keywords" content="giannis, basketball, nba, Aντετοκούμπο, Γιάννης Αντετοκούμπο, μπασκεμπολίστας" />
		<meta name="description" content="Γιάννης Αντετοκούνμπο: Εδώ θα βρείτε ακριβείς πληροφορίες σχετικά με τον διάσημο μπασκεμπολίστα" />
		
		<title>Σχόλια | Γιάννης Αντετοκούμπο</title>
		<link rel="stylesheet" type="text/css" href="css/central.css"/>
		<link rel="stylesheet" type="text/css" href="css/comments_styles.css"/>
		<link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
		<link rel="icon" href="favicon.ico" type="image/x-icon" />

	</head>
	<body>
		<?php 
		include ('banner.php');
		
		$email = $comment = "";
		$commentErr = "";
		
		function test_input($data) {
		  $data = trim($data);
		  $data = addslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		  
		  if (empty($_POST["email"])){
			  $email = "Άγνωστος";
		  }else{
			  $email = test_input($_POST["email"]);
		  }
		  if (empty($_POST["comment"])){
			  $commentErr = "Δεν επιτρέπονται κενά σχόλια";
		  }else{
			  $comment = test_input($_POST["comment"]);
		  }
		  
		}		
		
		if ($comment!=""){
			include('db_connection.php');
			$query = "INSERT INTO comments (email, main_text) VALUES ('$email','$comment')";
			if (!mysqli_query($link, $query)){
				echo "Error: " . $query . "<br>" . mysqli_error($link);
			}
			@mysqli_close($link);	
		}
		
		?>
		
		<main class = "main80" >
			<h2>Σχόλια</h2>
				<div id="reviews-form" >
					<h4>Μοιραστείτε τις δικές σας εντυπώσεις για τον Γιάννη Αντετοκούμπο</h4><br><br>
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<fieldset>
							<label for="email">Εmail</label> <br><br>
							<input type="email" name="email" size="50" maxlength="50" placeholder="Το Email σας"> <br><br><br>
							<label for="comment">Γράψτε ένα σχόλιο</label><span id="error"><?php echo "     ".$commentErr; ?></span> <br><br>
							<textarea required id="reviewinput" name="comment" rows="10" cols="80" placeholder="Το σχόλιό σας"></textarea><br><br>
							<input type="submit" value="Υποβολή Σχολίου">
						</fieldset>
							
					</form>
				</div>	
				<div id="reviews-container" class="reviews-container">
					<h4>Τι έγραψαν άλλοι</h4>
					<?php
						include('db_connection.php');
						$query = "SELECT email, main_text, date FROM comments ORDER BY comments.date DESC";
						$results = mysqli_query($link, $query);
						if ($num_results = mysqli_num_rows($results) > 0){
							while ($row = mysqli_fetch_assoc($results)){
								echo '<div class="single-review-container">';
								echo '<p id="email-name-container">'.$row["email"].'</p>';
								echo '<p id="timestamp-container">'.$row["date"].'</p>';
								echo '<p id="main-text-container">'.$row["main_text"].'</p>';
								echo '</div>';
								//echo '<br><br><br>';
							}
						}else{
							echo '<p id="main-text-container">Μπορείτε να είστε ο πρώτος που θα σχολιάσει! Εμπρός, συμπληρώστε παραπάνω! </p>';
						}
						
						
						@mysqli_close($link);
					?>
				</div>
				
			
				
			
		</main>	
		<?php include('footer.php') ?>
	</body>
</html>