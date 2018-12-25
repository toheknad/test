<?php
$mysqli = new mysqli("localhost", "root", "", "dbtest");
if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$html = '';
$comment = file_get_contents('comment.html');
$comment2 = file_get_contents('comment2.html');
$sql = "SELECT name,email,comment FROM comments";
$result = $mysqli->query($sql);
$i = 2;
while($data = $result->fetch_assoc()) {	
	if(($i % 2) == 0) {
		$html .= str_replace(['{{name}}','{{email}}','{{comment}}'], [$data['name'], $data['email'], $data['comment']], $comment);
	} else {
		$html .= str_replace(['{{name}}','{{email}}','{{comment}}'], [$data['name'], $data['email'], $data['comment']], $comment2);
	}
	$i++;
}


$index = file_get_contents('index.html');
$index = str_replace("{{comments}}", $html, $index);
echo $index;








?>
