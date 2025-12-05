<?php

function calculate($num1, $operator, $num2) {
    $add = fn($a, $b) => $a + $b;
    $sub = fn($a, $b) => $a - $b;
    $mul = fn($a, $b) => $a * $b;
    $pow = fn($a, $b) => $a ** $b;
    
    $div = function($a, $b) {
        return $b == 0 ? "Помилка: Ділення на нуль!" : $a / $b;
    };
    
    $mod = function($a, $b) {
        return $b == 0 ? "Помилка: Ділення на нуль!" : $a % $b;
    };

    try {
        return match ($operator) {
            '+' => $add($num1, $num2),
            '-' => $sub($num1, $num2),
            '*' => $mul($num1, $num2),
            '/' => $div($num1, $num2),
            '**' => $pow($num1, $num2),
            '%' => $mod($num1, $num2),
            default => throw new Exception("Невідомий оператор: '$operator'")
        };
    } catch (Exception $e) {
        return "Помилка: " . $e->getMessage();
    }
}

echo "=== КОНСОЛЬНИЙ КАЛЬКУЛЯТОР ===\n";
echo "Підтримувані оператори: +, -, *, /, **, %\n";
echo "Щоб вийти, введіть: exit\n";
echo "----------------------------------------\n";

while (true) {
    echo "\nВведіть вираз ";

    $input = trim(fgets(STDIN));

    if ($input === 'exit') {
        echo "Дякую за користування! До побачення.\n";
        break;
    }

    if (empty($input)) {
        continue;
    }

    $cleanInput = preg_replace('/\s+/', ' ', $input);
    $parts = explode(' ', $cleanInput);

    if (count($parts) !== 3) {
        echo ">> Помилка формату! Спробуйте ще раз (число пробіл оператор пробіл число).\n";
        continue;
    }

    list($num1, $operator, $num2) = $parts;

    if (!is_numeric($num1) || !is_numeric($num2)) {
        echo ">> Помилка: Введені дані мають бути числами.\n";
        continue;
    }

    $result = calculate((float)$num1, $operator, (float)$num2);

    echo ">> Результат: $result\n";
}

echo "\nНатисніть Enter, щоб закрити вікно...";
fgets(STDIN);

?>