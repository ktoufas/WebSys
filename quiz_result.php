<?php
	session_start();
	if (!isset($_SESSION['stats'])){
		$_SESSION['stats'] = 0; //Keeps track of correct answers
	}
	$c_ans = $_SESSION['correctAns']; //Correct answer
	$g_ans = $_GET['ans']; //Given answer
	if($g_ans==$c_ans){
		$_SESSION['stats'] = $_SESSION['stats'] + 1; 
		echo "<div class='resultBox' id='correctBox'>ΣΩΣΤΗ</div>";

	}else{
		echo "<div class='resultBox' id='wrongBox'>ΛΑΘΟΣ</div>";
	}
?>