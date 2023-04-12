<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
</head>
<body>
<h1>Polling Officer Panel</h1>
<h2>Polling results</h2>
<?php
include "db_functions.php";
$conn = connect_to_db();
$data = tally_votes($conn);

//show the top two candidates
echo "<h3>Top two candidates: </h3>";

for ($i = 0; $i< 2; $i++){
    $row = $data->fetch_assoc();
    echo $row['name'] . '<br>';
}

//reset data
$data = tally_votes($conn);

//show the whole result
echo "<h3>full results: </h3>";
while ($row = $data->fetch_assoc()){
    echo $row['name'] . ', ' . $row['num_votes'] . '<br>';
}

//show the lowest voted candidate
echo "<h3>losing candidate: </h3>";
$data = get_losing_votes($conn);
while ($row = $data->fetch_assoc()){
    echo $row['name'] . '<br>';
}

//reset the data
$data = tally_votes($conn);

//show the winner again
echo "<h3>winning candidate: </h3>";
echo $data->fetch_assoc()['name'] . '<br>';
?>

<button id="btnLogin" onclick="location.href='./login.html'">Back to Login</button>
</body>
</html>