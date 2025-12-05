<?php

function rollDice() {
    return rand(1, 6);
}

function validate($inputParam) {
    if ($inputParam === false) {
        return '';
    }
    return trim($inputParam);
}

function playGame() {
    $score = 0;
    $target = 20;

    echo "=== ГРА ROLL THE DICE ===\n";
    echo "Ціль: досягти рівно $target очок.\n";
    echo "Якщо випаде 6 — активується СУПЕРКИДОК (перекидання без додавання 6).\n";
    echo "Початковий рахунок: $score\n\n";

    while (true) {
        echo "Натисніть Enter, щоб зробити кидок...";
        
        $input = fgets(STDIN);
        validate($input); 
        $currentRoll = rollDice();

        if ($currentRoll === 6) {
            echo ">> Кидок: 6. Суперкидок! \n";
            echo ">> Ви отримуєте нову спробу замість додавання 6.\n";
            echo "Натисніть Enter, щоб зробити суперкидок...";
            
            $input = fgets(STDIN);
            validate($input);

            $currentRoll = rollDice();
        }

        $score += $currentRoll;

        echo ">> Кидок: $currentRoll. Загальний рахунок: $score\n";
        echo "------------------------------------------------\n";

        if ($score === $target) {
            echo "\nВІТАЮ! Ви набрали рівно $target очок. Перемога!\n";
            break;
        } elseif ($score > $target) {
            echo "\nО ні! Рахунок $score перевищує $target. Ви програли.\n";
            break;
        }
    }
}
playGame();

?>