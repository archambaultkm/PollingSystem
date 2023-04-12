<?php
function connect_to_db() {
    $sname= "localhost";
    $username = "root";
    $password = "";
    $db_name = "PollingsystemDB";

    $conn = new mysqli($sname, $username, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

//used to add a new user using an existing db connection
function insert_user($conn, $user) {

    if ($user->isAdmin)
        $admin = 1;
    else
        $admin = 0;

    $query = $conn->prepare("INSERT INTO User(username, password, is_admin) VALUE (?, ?, ?)");
    $query->bind_param("sss", $user->username, $user->password, $admin);
    $query->execute();
}

//see if a user exists
function find_user($conn, $username, $password) {
    $query = $conn->prepare("SELECT * FROM User WHERE username = ? AND password = ?");
    $query->bind_param("ss", $username, $password);
    $query->execute();

    return $query->get_result();
}

function get_candidate_list($conn) {
    $query = $conn->prepare("SELECT * FROM Voting_Options");
    $query->execute();

    return $query->get_result();
}

//even if these functions aren't used I thought I'd keep them
function insert_candidate($conn, $name) {
    $query = $conn->prepare("INSERT INTO Voting_Options(name) VALUE (?)");
    $query->bind_param("s", $name);
    $query->execute();
}

function delete_candidate($conn, $name) {
    $query = $conn->prepare("DELETE FROM Voting_Options WHERE name = ?");
    $query->bind_param("s", $name);
    $query->execute();
}

function add_vote_to_candidate($conn, $name) {
    $query = $conn->prepare("UPDATE Voting_Options SET num_votes = num_votes + 1 WHERE name = ?");
    $query->bind_param("s", $name);
    $query->execute();
}

function tally_votes($conn) {
    $query = $conn->prepare("SELECT name, num_votes FROM Voting_Options ORDER BY num_votes DESC");
    $query->execute();

    return $query->get_result();
}

//if there's a tie for losers it will just show one
function get_losing_votes($conn) {
    $query = $conn->prepare("SELECT name, num_votes FROM `Voting_Options` ORDER BY num_votes ASC limit 1");
    $query->execute();

    return $query->get_result();
}