<?php
require_once "includes/sessions.php";
require_once "includes/helpers.php";

$questions = loadQuestions();

/* Select Question */
if (isset($_POST['action']) && $_POST['action'] === 'select_question') {

    $category = $_POST['category'];
    $value = $_POST['value'];

    // Save selected question
    $_SESSION['current_question'] = [
        'category' => $category,
        'value'    => $value,
        'question' => $questions[$category][($value/200)-1]['question'],
        'answer'   => $questions[$category][($value/200)-1]['answer'],
    ];

    $_SESSION['question_mode'] = true; // Switch screen mode

    exit(header("Location: board.php"));
}


/* Update Scores */
if (isset($_POST['action']) && $_POST['action'] === 'score_update') {

    $value = $_POST['value'];
    $change = $_POST['change']; // + or -

    $player = $_SESSION['current_player'];

    if ($change === '+') {
        $_SESSION['scores'][$player - 1] += $value;
    } else {
        $_SESSION['scores'][$player - 1] -= $value;
    }

    // Mark the tile as used
    $cat = $_SESSION['current_question']['category'];
    $val = $_SESSION['current_question']['value'];
    markTileUsed($cat, $val);

    // Move to next player (only if wrong answer)
    if ($change === '-') {
        nextPlayer();
    }

    // Return to board mode
    unset($_SESSION['question_mode']);
    unset($_SESSION['current_question']);

    exit(header("Location: board.php"));
}


/* Final Jeopardy Wager */
if (isset($_POST['action']) && $_POST['action'] === 'submit_wager') {

    $wagers = $_POST['wager'];
    $answer = trim($_POST['fj_answer']);

    $_SESSION['final_wagers'] = $wagers;

    // Compare answer
    $finalQ = $_SESSION['final_question'];

    foreach ($_SESSION['scores'] as $i => $score) {
        if (isset($wagers[$i])) {
            $wager = intval($wagers[$i]);

            if (strcasecmp($answer, $finalQ['answer']) == 0) {
                $_SESSION['scores'][$i] += $wager;
            } else {
                $_SESSION['scores'][$i] -= $wager;
            }
        }
    }

    $_SESSION['game_over'] = true;

    exit(header("Location: board.php"));
}

/* Check for Final Jeopardy Trigger */
if (allTilesUsed() && !isset($_SESSION['final_question']) && !isset($_SESSION['game_over'])) {

    $_SESSION['final_question'] = [
        "question" => "This 1815 battle, fought in present-day Belgium, ended Napoleon's rule and the Napoleonic Wars",
        "answer"   => "Battle of Waterloo"
    ];

    $_SESSION['final_mode'] = true;
}

include "includes/header.php";
?>

<link rel="stylesheet" href="css/board.css">

<div class="board-container">

<?php

/* Questions */
if (isset($_SESSION['question_mode']) && $_SESSION['question_mode'] === true):

    $q = $_SESSION['current_question'];
?>
    <div class="question-screen">
        <h2 class="question-header"><?php echo htmlspecialchars($q['category']) . " - $" . $q['value']; ?></h2>
        <p class="question-text"><?php echo htmlspecialchars($q['question']); ?></p>

        <form method="POST" class="score-form">
            <input type="hidden" name="action" value="score_update">
            <input type="hidden" name="value" value="<?php echo $q['value']; ?>">

            <button name="change" value="+" class="btn btn-correct">+ Correct</button>
            <button name="change" value="-" class="btn btn-wrong">- Incorrect</button>
        </form>

        <div class="answer-box">
            <strong>Correct Answer:</strong> <?php echo htmlspecialchars($q['answer']); ?>
        </div>
    </div>

<?php
/* Final Jeopardy */
elseif (isset($_SESSION['final_mode'])):

    $fq = $_SESSION['final_question'];
?>
    <div class="final-jeopardy">
        <h2>Final Jeopardy!</h2>
        <p class="final-question"><?php echo htmlspecialchars($fq['question']); ?></p>

        <form method="POST" class="final-form">
            <input type="hidden" name="action" value="submit_wager">

            <div class="wager-section">
                <?php foreach ($_SESSION['scores'] as $i => $score): ?>
                    <?php if ($score > 0): ?>
                        <div class="wager-input">
                            <label>Player <?php echo $i+1; ?> wager (Current: $<?php echo $score; ?>):</label>
                            <input type="number" name="wager[<?php echo $i; ?>]" max="<?php echo $score; ?>" min="0" value="0" required>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <div class="answer-input">
                <label>Your answer:</label>
                <input type="text" name="fj_answer" required>
            </div>

            <button type="submit" class="btn btn-submit">Submit Final Answer</button>
        </form>
    </div>

<?php

/* Game Over */
elseif (isset($_SESSION['game_over'])):
    
    // Sort scores to find winner
    $players = [];
    foreach ($_SESSION['scores'] as $i => $score) {
        $players[] = ['id' => $i+1, 'score' => $score];
    }
    usort($players, function($a, $b) { return $b['score'] - $a['score']; });
?>
    <div class="game-over">
        <h2>🏆 Game Over – Final Scores 🏆</h2>
        
        <div class="winner-announce">
            <p class="winner-text">Winner: Player <?php echo $players[0]['id']; ?></p>
            <p class="winner-score">$<?php echo $players[0]['score']; ?></p>
        </div>

        <div class="final-standings">
            <h3>Final Standings:</h3>
            <?php foreach ($players as $idx => $player): ?>
                <p class="standing-<?php echo $idx+1; ?>">
                    <?php 
                    if ($idx === 0) echo '🥇 ';
                    elseif ($idx === 1) echo '🥈 ';
                    elseif ($idx === 2) echo '🥉 ';
                    ?>
                    Player <?php echo $player['id']; ?>: $<?php echo $player['score']; ?>
                </p>
            <?php endforeach; ?>
        </div>

        <form method="POST" action="process/reset.php">
            <button class="btn btn-restart">Play Again</button>
        </form>
    </div>

<?php

/* Main Jeopardy Board */
else:
?>

<h1 class="jeopardy-title">Jeopardy</h1>

<div class="turn-indicator">
    Current Turn: <span class="current-player">Player <?php echo $_SESSION['current_player']; ?></span>
</div>

<div class="score-area">
    <?php foreach ($_SESSION['scores'] as $i => $score): ?>
        <div class="player-score <?php echo ($i+1 === $_SESSION['current_player']) ? 'active-player' : ''; ?>">
            <div class="player-name">Player <?php echo $i+1; ?></div>
            <div class="player-points">$<?php echo $score; ?></div>
        </div>
    <?php endforeach; ?>
</div>

<div class="board-grid">

    <?php foreach ($questions as $category => $qList): ?>
        <div class="category-header"><?php echo htmlspecialchars($category); ?></div>
    <?php endforeach; ?>

    <?php for ($i=0; $i<5; $i++): ?>
        <?php foreach ($questions as $category => $qList): 
            $value = $qList[$i]["value"];
            $tileId = $category . "_" . $value;
            $used = isTileUsed($category, $value);
        ?>
        <div class="tile <?php echo $used ? 'used' : ''; ?>">
            <?php if (!$used): ?>
                <form method="POST">
                    <input type="hidden" name="action" value="select_question">
                    <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
                    <input type="hidden" name="value" value="<?php echo $value; ?>">
                    <button class="tile-btn">$<?php echo $value; ?></button>
                </form>
            <?php else: ?>
                <span class="used-text">—</span>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php endfor; ?>

</div>

<?php endif; ?>

</div>

<?php include "includes/footer.php"; ?>
