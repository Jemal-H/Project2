<?php
// Start session only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['players'])) {
    $_SESSION['players'] = 0; // Number of players
}

if (!isset($_SESSION['scores'])) {
    $_SESSION['scores'] = []; // Filled with team's scores
}

if (!isset($_SESSION['current_player'])) {
    $_SESSION['current_player'] = 1; // Default starting player
}

if (!isset($_SESSION['used_tiles'])) {
    $_SESSION['used_tiles'] = []; // Stores used tiles
}

// For final jeopardy
if (!isset($_SESSION['final_wagers'])) {
    $_SESSION['final_wagers'] = [];
}

if (!isset($_SESSION['final_question'])) {
    $_SESSION['final_question'] = null;
}
?>
