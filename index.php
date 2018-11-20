<?php
$delimiterLine = "<BR>";
echo 'Задание № 1' . $delimiterLine;
include('function.php');
echo "<pre>";
print_r(task1());

echo $delimiterLine . 'Задание № 2' . $delimiterLine;
//echo "Выполняем задачи № 1 и 2" . $delimiterLine;
task2(2, 3, 100, 10);

echo $delimiterLine . 'Задание № 3' . $delimiterLine;
task3();

echo $delimiterLine . 'Задание № 4' . $delimiterLine;
task4();
