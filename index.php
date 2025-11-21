<?php
require_once "includes/sessions.php";

// If game already started, redirect to board
if (isset($_SESSION['players']) && $_SESSION['players'] > 0) {
    header("Location: board.php");
    exit;
}

include "includes/header.php";
?>

<link rel="stylesheet" href="css/board.css">

<style>
.home-container {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.home-box {
    background: #000000;
    border: 8px solid #374151;
    border-radius: 2rem;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
    padding: 3rem;
    max-width: 600px;
    width: 100%;
    text-align: center;
}

.home-title {
    font-family: 'Gyparody', 'Arial Black', sans-serif;
    font-size: 5rem;
    color: #ffffff;
    text-shadow: 3px 3px 0px rgba(0, 0, 0, 0.8);
    margin-bottom: 2rem;
}

.team-form {
    margin-top: 2rem;
}

.form-group {
    margin-bottom: 2rem;
}

.form-group label {
    display: block;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #ffffff;
}

.team-select {
    background: #ffffff;
    color: #000000;
    font-size: 1.25rem;
    padding: 0.75rem 1.5rem;
    border: 4px solid #2563eb;
    border-radius: 0.5rem;
    font-weight: 600;
    width: 12rem;
    text-align: center;
    cursor: pointer;
}

.btn-start {
    background: #2563eb;
    color: #ffffff;
    font-size: 1.875rem;
    font-weight: 700;
    padding: 1rem 4rem;
    border: 4px solid #60a5fa;
    border-radius: 9999px;
    cursor: pointer;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
    transition: all 0.2s;
}

.btn-start:hover {
    background: #3b82f6;
    transform: scale(1.05);
}
</style>

<div class="home-container">
    <div class="home-box">
        <h1 class="home-title">Jeopardy</h1>
        
        <form method="POST" action="process/init_game.php" class="team-form">
            <div class="form-group">
                <label for="num_players">Number of Players</label>
                <select name="num_players" id="num_players" class="team-select" required>
                    <option value="1">1 Player</option>
                    <option value="2" selected>2 Players</option>
                    <option value="3">3 Players</option>
                    <option value="4">4 Players</option>
                </select>
            </div>
            
            <button type="submit" class="btn-start">Start Game</button>
        </form>
    </div>
</div>

<?php include "includes/footer.php"; ?>
