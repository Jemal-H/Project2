<?php
// Start session only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure base session structure exists
if (!isset($_SESSION['players'])) {
    $_SESSION['players'] = 0; // Number of players will be set at init_game.php
}

if (!isset($_SESSION['scores'])) {
    $_SESSION['scores'] = []; // Will be filled with player scores
}

if (!isset($_SESSION['current_player'])) {
    $_SESSION['current_player'] = 1; // Default starting player (overwritten later)
}

if (!isset($_SESSION['used_tiles'])) {
    $_SESSION['used_tiles'] = []; // Stores used tiles (e.g. "History_200")
}

// Used later for final jeopardy
if (!isset($_SESSION['final_wagers'])) {
    $_SESSION['final_wagers'] = [];
}

if (!isset($_SESSION['final_question'])) {
    $_SESSION['final_question'] = null;
}
?>
