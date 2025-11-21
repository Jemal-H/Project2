<?php
require_once "../includes/sessions.php";

// Get number of players
$numPlayers = isset($_POST['num_players']) ? (int)$_POST['num_players'] : 2;

// Validate
if ($numPlayers < 1 || $numPlayers > 4) {
    $numPlayers = 2;
}

// Initialize game state
$_SESSION['players'] = $numPlayers;
$_SESSION['scores'] = array_fill(0, $numPlayers, 0);
$_SESSION['current_player'] = rand(1, $numPlayers);
$_SESSION['used_tiles'] = [];
$_SESSION['final_wagers'] = [];
$_SESSION['final_question'] = null;

// Clear any previous game state
unset($_SESSION['question_mode']);
unset($_SESSION['current_question']);
unset($_SESSION['final_mode']);
unset($_SESSION['game_over']);

// Redirect to game board
header("Location: ../board.php");
exit;
?>
