<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
	$name  	 = $_POST['name'];
	$email 	 = $_POST['email'];
	$comment = $_POST['comment'];


		$mysqli = new mysqli("localhost", "root", "", "dbtest");
		if ($mysqli->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "INSERT INTO dbtest.comments (name, email, comment)
				VALUES ('$name','$email','$comment')";
		$result = $mysqli->query($sql);
		$id = $mysqli->insert_id;

		$sql = "SELECT COUNT(*) FROM comments";
		$coll = $mysqli->query($sql);
		$coll = $coll->fetch_assoc();

		$html = '';
		$comment = file_get_contents('comment.html');
		$sql = "SELECT name,email,comment FROM comments WHERE id =".$id;
	
		$result = $mysqli->query($sql);
		while($data = $result->fetch_assoc()) {	
		
			$html = str_replace(['{{name}}','{{email}}','{{comment}}'], [$data['name'], $data['email'], $data['comment']], $comment);
		}
		
		echo $html;
	
}

?>