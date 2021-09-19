<?php namespace OneRayMan\ticTacToe\Controller;
    use function OneRayMan\ticTacToe\View\showGame;
    
    function startGame() {
        echo "Game started".PHP_EOL;
        showGame();
    }
?>