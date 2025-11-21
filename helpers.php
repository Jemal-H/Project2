<?php

/* Load questions.json */
function loadQuestions() {
    $path = __DIR__ . '/../data/questions.json';

    if (!file_exists($path)) {
        die("Error: questions.json not found in /data folder.");
    }

    $json = file_get_contents($path);
    return json_decode($json, true);
}


/* Rotates to next player */
function nextPlayer() {
    $totalPlayers = $_SESSION['players'];

    $_SESSION['current_player']++;

    if ($_SESSION['current_player'] > $totalPlayers) {
        $_SESSION['current_player'] = 1;
    }
}


/* Marks a tile as picked */
function markTileUsed($category, $value) {
    $tileId = $category . "_" . $value;
    $_SESSION['used_tiles'][$tileId] = true;
}


/* Check if a tile has been picked. */
function isTileUsed($category, $value) {
    $tileId = $category . "_" . $value;
    return isset($_SESSION['used_tiles'][$tileId]);
}


/* Returns TRUE if all tiles are picked. */
function allTilesUsed() {
    $questions = loadQuestions();
    $totalTiles = 0;
    $usedTiles = count($_SESSION['used_tiles']);

    foreach ($questions as $category => $qList) {
        $totalTiles += count($qList);
    }

    return $usedTiles >= $totalTiles;
}

function debugSession() {
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
}
?>
