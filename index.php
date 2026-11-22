<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');

/** Красиво выводит массив: подпись + элементы через запятую + количество. */
function show(string $title, array $arr): void
{
    echo '<p><strong>' . htmlspecialchars($title) . ':</strong> [' .
        htmlspecialchars(implode(', ', $arr)) . '] ' .
        '<em>(элементов: ' . count($arr) . ')</em></p>';
}

/** Убирает дубликаты и переиндексирует массив (array_unique сохраняет старые ключи). */
function removeDuplicates(array $arr): array
{
    return array_values(array_unique($arr));
}

/** Разворот массива циклом foreach (без array_reverse). */
function reverseWithForeach(array $arr): array
{
    $result = [];
    foreach ($arr as $value) {
        array_unshift($result, $value); // каждый следующий элемент ставим в начало
    }
    return $result;
}

// ---------- Исходные данные: два произвольных целочисленных массива ----------
$array1 = [5, 3, 8, 3, 1, 5, 9, 2, 8];
$array2 = [4, 8, 2, 7, 2, 9, 6, 4, 10];
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №4, вариант 7</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 30px auto; padding: 0 16px; }
        h2 { border-bottom: 2px solid #4a7; padding-bottom: 4px; margin-top: 28px; }
    </style>
</head>
<body>
    <h1>Работа с массивами (вариант 7)</h1>

    <h2>0. Исходные массивы</h2>
    <?php
    show('Массив 1', $array1);
    show('Массив 2', $array2);
    ?>

    <h2>1. Удаление дублирующихся элементов в каждом массиве</h2>
    <?php
    $unique1 = removeDuplicates($array1);
    $unique2 = removeDuplicates($array2);
    show('Массив 1 без дублей', $unique1);
    show('Массив 2 без дублей', $unique2);
    echo '<p>Удалено дублей: в массиве 1 — ' . (count($array1) - count($unique1)) .
         ', в массиве 2 — ' . (count($array2) - count($unique2)) . '.</p>';
    ?>

    <h2>2. Количество элементов, дублирующихся в двух массивах</h2>
    <?php
    // Считаем по массивам без внутренних дублей, чтобы не учитывать значение дважды.
    $common = array_values(array_intersect($unique1, $unique2));
    show('Общие элементы', $common);
    echo '<p>Количество дублирующихся между массивами элементов: <strong>' . count($common) . '</strong></p>';
    ?>

    <h2>3. Слияние массивов без дублей</h2>
    <?php
    $merged = removeDuplicates(array_merge($unique1, $unique2));
    show('Объединённый массив', $merged);
    ?>

    <h2>4. Разворот значений через foreach</h2>
    <?php
    show('Объединённый массив (до)', $merged);
    show('Объединённый массив (после)', reverseWithForeach($merged));
    show('Массив 1 развёрнутый', reverseWithForeach($unique1));
    show('Массив 2 развёрнутый', reverseWithForeach($unique2));
    ?>
</body>
</html>