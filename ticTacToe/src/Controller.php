<?php 
	namespace onerayman\TicTacToe\Controller;

    use onerayman\ticTacToe\Model\Board as Board;
    use Exception as Exception;
    use LogicException as LogicException;
	
	use function cli\prompt;
    use function cli\line;
    use function cli\out;

    use function onerayman\TicTacToe\View\showGameBoard;
    use function onerayman\TicTacToe\View\showMessage;
    use function onerayman\TicTacToe\View\getValue;

    use const onerayman\TicTacToe\Model\PLAYER_X_MARKUP;
    use const onerayman\TicTacToe\Model\PLAYER_O_MARKUP;

function startGame()
{
   
    while (true) {
        $command = prompt("Enter key(--new,--list,--help,--exit)");
        $gameBoard = new Board();
        if ($command == "--new" || $command == "-n") {
        $gameBoard = new Board();
        initialize($gameBoard);
        gameLoop($gameBoard);
        inviteToContinue($canContinue);
        } elseif ($command == "--list" || $command == "-l") {
            line("Will be realized in the future");
        } elseif (preg_match('/(^--replay [0-9]+$)/', $command) != 0) {
            $id = explode(' ', $command)[1];
            replayGame($gameBoard, $id);
        } 
		elseif ($command == "--help" || $command == "-h") {
		gameHelp();
		}
		elseif ($command == "--exit" || $command == "-e") {
            exit("Thanks for using\n");
        }
		else {
            line("Key not found");
        }
    }
}

function initialize($board)
{
    try {
        $board->setDimension(getValue("Enter the field size "));
        $board->initialize();
    } catch (Exception $e) {
        showMessage($e->getMessage());
        initialize($board);
    }
}

function gameLoop($board)
{
    $stopGame = false;
    $currentMarkup = PLAYER_X_MARKUP;
    $endGameMsg = "";

    do {
        showGameBoard($board);
        if ($currentMarkup == $board->getUserMarkup()) {
            processUserTurn($board, $currentMarkup, $stopGame);
            $endGameMsg = "Player '$currentMarkup' won!";
            $currentMarkup = $board->getComputerMarkup();
        } else {
            processComputerTurn($board, $currentMarkup, $stopGame);
            $endGameMsg = "Player '$currentMarkup' won!";
            $currentMarkup = $board->getUserMarkup();
        }

        if (!$board->isFreeSpaceEnough() && !$stopGame) {
            showGameBoard($board);
            $endGameMsg = "Draw!";
            $stopGame = true;
        }
    } while (!$stopGame);

    showGameBoard($board);
    showMessage($endGameMsg);
}

function processUserTurn($board, $markup, &$stopGame)
{
    $answerTaked = false;
    do {
        try {
            $coords = getCoords($board);
            $board->setMarkupOnBoard($coords[0], $coords[1], $markup);
            if ($board->determineWinner($coords[0], $coords[1]) !== "") {
                $stopGame = true;
            }

            $answerTaked = true;
        } catch (Exception $e) {
            showMessage($e->getMessage());
        }
    } while (!$answerTaked);
}

function getCoords($board)
{
    $markup = $board->getUserMarkup();
    $coords = getValue("Enter the coordinates for the player '$markup' through '-'. First Y coordinate, second X coordinate([y]-[x])");
    $coords = explode("-", $coords);
    $coords[0] = $coords[0];
    if (isset($coords[1])) {
        $coords[1] = $coords[1];
    } else {
        throw new Exception("No second coordinate. Please try again.");
    }
    return $coords;
}

function processComputerTurn($board, $markup, &$stopGame)
{
    $answerTaked = false;
    do {
        $i = rand(0, $board->getDimension() - 1);
        $j = rand(0, $board->getDimension() - 1);
        try {
            $board->setMarkupOnBoard($i, $j, $markup);
            if ($board->determineWinner($i, $j) !== "") {
                $stopGame = true;
            }

            $answerTaked = true;
        } catch (Exception $e) {
        }
    } while (!$answerTaked);
}

function inviteToContinue(&$canContinue)
{
    $answer = "";
    do {
        $answer = getValue("Do you want to continue? (y/n)");
        if ($answer === "y") {
            $canContinue = true;
        } elseif ($answer === "n") {
            exit("Thanks for using\n");
        }
    } while ($answer !== "y" && $answer !== "n");
}

function gameHelp(){
	line("'Tic-tac-toe' with a computer on a field of arbitrary size (from 3x3 to 10x10)");
	line("You can use following keys when start the program:");
	line("--new or -n - start new game;");
	line("--list or -l - show list of all games;");
	line("--help or -h - show short info about the game.");
	line("--exit or -e - exit from the game.");
	}