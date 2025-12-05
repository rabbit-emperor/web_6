<?php

function validate($inputParam) {
    $cleanInput = trim($inputParam);

    if (!is_numeric($cleanInput) || intval($cleanInput) != $cleanInput) {
        return false;
    }

    $number = intval($cleanInput);

    if ($number < 1 || $number > 100) {
        return false;
    }

    return $number;
}

function playGame($maxAttempts) {
    $secretNumber = rand(1, 100);
    
    echo "Я загадав число від 1 до 100. Спробуй вгадати.\n";
    echo "У тебе є {$maxAttempts} спроб.\n";

    $compareNumbers = function($userGuess, $secret) {
        if ($userGuess > $secret) {
            return "less"; 
        } elseif ($userGuess < $secret) {
            return "more"; 
        } else {
            return "equal"; 
        }
    };

    $isWin = false;

    for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
        echo "\nСпроба $attempt: ";
        $input = fgets(STDIN);
        
        $guess = validate($input);

        if ($guess === false) {
            echo "Помилка! Будь ласка, введіть ціле число від 1 до 100.\n";
            $attempt--; 
            continue;
        }

        $result = $compareNumbers($guess, $secretNumber);

        if ($result === "equal") {
            echo "Вітаю! Ти вгадав число $secretNumber за $attempt спроб(и).\n";
            $isWin = true;
            break;
        } elseif ($result === "less") {
            echo "Спробуй менше.\n";
        } elseif ($result === "more") {
            echo "Спробуй більше.\n";
        }
    }

    if (!$isWin) {
        echo "\nНа жаль, спроби закінчилися. Я загадав число: $secretNumber.\n";
    }
}

playGame(7);

?>