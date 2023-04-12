<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voting</title>
</head>
<body>
<h1> Vote here </h1>

<div id="poll">
    <h3>Pick your favourite candidate</h3>
    <form method="post">
        <?php
            include "db_functions.php";
            $conn = connect_to_db();

            //print all available candidates
            foreach (get_candidate_list($conn) as $candidate)
                echo '<input type="radio" name="vote" value="'. $candidate['name'] .'" > ' . $candidate['name'] . '<br>';
            ?>
<!--        when a vote is submitted, increment their number of votes and move them out of the voting screen-->
        <button type="submit" name="submit_vote" onclick="<?php add_vote_to_candidate($conn, $_POST['vote']); header("Location: thank_you.html");?>">Submit Vote</button>
    </form>
</div>

<button id="btnLogin" onclick="location.href='./login.html'">Back to Login</button>

</body>
</html>