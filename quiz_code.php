<?php 
	include("db_connection.php");
	$query = "SELECT * FROM questions";
	$questions = mysqli_query($link, $query); //Query results
	$counter = 0;
	$ask = true;

	session_start();
	if(isset($_GET['init'])){ //In case of page redirection or new game we need to reset the asked_questions session variable
		unset($_SESSION['quiz']);
		unset($_SESSION['stats']);
	}
	if(!isset($_SESSION['correctAns'])){ //Initialize correct answer 
			$_SESSION['correctAns'] = 0;
	}		
	if(!isset($_SESSION['quiz'])){ //Initialize session array 
			$_SESSION['quiz'] = array();
	}
		
	
	$r_id = mt_rand(1, mysqli_num_rows($questions)); // get random question
	while(q_asked($r_id)){ //if the random question has been asked make another
		if(count($_SESSION['quiz'])==5){ //if all 5 questions have been asked
		$success = $_SESSION['stats'];
		echo "<div id='resultStats' class='resultBox'>ΣΩΣΤΕΣ ΑΠΑΝΤΗΣΕΙΣ: $success / 5\n";
		echo "<br><input name='newGame' id='newGame' type='button' onclick='getResponse(1)' value='ΝΕΟ ΠΑΙΧΝΙΔΙ'></div>\n";
		$ask = false;
		break;
		}
		$r_id = mt_rand(1, mysqli_num_rows($questions));
	}
	
	while ($row = mysqli_fetch_row($questions)) {
  		if($row[0]!=$r_id){
  			continue;
  		}
  		if(!$ask){ break; }
    $_SESSION['correctAns'] = $row[5];
    echo "<div class='qBox'> $row[1] </div>\n";
    echo "<div id='aboxContainer'>\n";
    echo "<div class='aBox'><img id='as1' src='images/quiz/$row[2]' alt='$row[2]' onclick='evaluateAnswer(1)'></div>\n";
    echo "<div class='aBox'><img id='as2' src='images/quiz/$row[3]' alt='$row[3]' onclick='evaluateAnswer(2)'></div>\n";
    echo "<div class='aBox'><img id='as3' src='images/quiz/$row[4]' alt='$row[4]' onclick='evaluateAnswer(3)'></div>\n";
    echo "</div>\n";
    $_SESSION['quiz'][] = $r_id;
    break;
  }

function q_asked($q_id){
	for($i=0;$i<count($_SESSION['quiz']);$i++){
		if($_SESSION['quiz'][$i]==$q_id){
			return true;
		}
	}
	return false;

}
	mysqli_close($link);
?>