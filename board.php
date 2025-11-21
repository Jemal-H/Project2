<?php
require_once "includes/session.php";
require_once "includes/helpers.php";

$questions = loadQuestions();

/* -------------------------------
   1. SELECT QUESTION HANDLER
--------------------------------*/
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


/* -------------------------------
   2. UPDATE SCORE HANDLER (+ / -)
--------------------------------*/
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

    // Move to next player
    nextPlayer();

    // Return to board mode
    unset($_SESSION['question_mode']);
    unset($_SESSION['current_question']);

    exit(header("Location: board.php"));
}


/* -------------------------------
   3. FINAL JEOPARDY WAGER HANDLER
--------------------------------*/
if (isset($_POST['action']) && $_POST['action'] === 'submit_wager') {

    $wagers = $_POST['wager'];
    $answer = trim($_POST['fj_answer']);

    $_SESSION['final_wagers'] = $wagers;

    // Compare answer
    $finalQ = $_SESSION['final_question'];

    foreach ($_SESSION['scores'] as $i => $score) {
        $wager = intval($wagers[$i]);

        if (strcasecmp($answer, $finalQ['answer']) == 0) {
            $_SESSION['scores'][$i] += $wager;
        } else {
            $_SESSION['scores'][$i] -= $wager;
        }
    }

    $_SESSION['game_over'] = true;

    exit(header("Location: board.php"));
}


/* -------------------------------
   4. IF ALL TILES USED → FINAL MODE
--------------------------------*/
if (allTilesUsed() && !isset($_SESSION['final_question'])) {

    $_SESSION['final_question'] = [
        "question" => "This is your Final Jeopardy question!",
        "answer"   => "Example Answer"
    ];

    $_SESSION['final_mode'] = true;
}

include "includes/header.php";
?>

<link rel="stylesheet" href="css/board.css">

<div class="board-container">

<?php
/* -------------------------------
   VIEW: QUESTION SCREEN
--------------------------------*/
if (isset($_SESSION['question_mode']) && $_SESSION['question_mode'] === true):

    $q = $_SESSION['current_question'];
?>
    <h2><?php echo $q['category'] . " - $" . $q['value']; ?></h2>
    <p class="question-text"><?php echo $q['question']; ?></p>

    <form method="POST">
        <input type="hidden" name="action" value="score_update">
        <input type="hidden" name="value" value="<?php echo $q['value']; ?>">

        <button name="change" value="+">Correct (+)</button>
        <button name="change" value="-">Incorrect (–)</button>
    </form>

    <div class="answer">
        <strong>Correct Answer:</strong> <?php echo $q['answer']; ?>
    </div>

<?php
/* -------------------------------
   VIEW: FINAL JEOPARDY SCREEN
--------------------------------*/
elseif (isset($_SESSION['final_mode'])):

    $fq = $_SESSION['final_question'];
?>
    <h2>Final Jeopardy</h2>
    <p><?php echo $fq['question']; ?></p>

    <form method="POST">
        <input type="hidden" name="action" value="submit_wager">

        <?php foreach ($_SESSION['scores'] as $i => $score): ?>
            <?php if ($score > 0): ?>
                <div>
                    Player <?php echo $i+1; ?> wager:
                    <input type="number" name="wager[<?php echo $i; ?>]" max="<?php echo $score; ?>" min="0" required>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <p>Your answer:</p>
        <input type="text" name="fj_answer" required>

        <button type="submit">Submit Final Answer</button>
    </form>

<?php
/* -------------------------------
   VIEW: GAME OVER SCREEN
--------------------------------*/
elseif (isset($_SESSION['game_over'])):
?>
    <h2>Game Over – Final Scores</h2>
    <?php foreach ($_SESSION['scores'] as $i => $score): ?>
        <p>Player <?php echo $i+1; ?>: <?php echo $score; ?></p>
    <?php endforeach; ?>

    <form method="POST" action="process/reset.php">
        <button>Restart Game</button>
    </form>

<?php
/* -------------------------------
   VIEW: MAIN JEOPARDY BOARD
--------------------------------*/
else:
?>

<h1>Jeopardy</h1>

<div class="turn-indicator">
    Current Turn: Player <?php echo $_SESSION['current_player']; ?>
</div>

<div class="score-area">
    <?php foreach ($_SESSION['scores'] as $i => $score): ?>
        <div class="player-score <?php echo ($i+1 === $_SESSION['current_player']) ? 'active-player' : ''; ?>">
            Player <?php echo $i+1; ?>: <?php echo $score; ?>
        </div>
    <?php endforeach; ?>
</div>

<div class="board-grid">

    <?php foreach ($questions as $category => $qList): ?>
        <div class="category-header"><?php echo $category; ?></div>
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
                    <input type="hidden" name="category" value="<?php echo $category; ?>">
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

