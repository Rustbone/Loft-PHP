<?php
require 'src/functions.php';

$string1 = 'Карл у Клары украл Кораллы';
$string2 = 'Две бутылки лимонада';

task1([1, 2, 3], $return = false);
echo '<br>';
echo task1([1, 2, 3], $return = true);
echo '<br>';
echo task2('+', 1, 2, 3, 5.5);
echo '<br>';
echo task2('*', 1, 2, 3, 5.5);
echo '<br>';
echo task2('/', 1, 2, 3, 5.5);
echo '<br>';
echo task2('sdfh', 1, 2, 3, 5.5);
echo '<br>';
echo task3(4, 5);
echo '<br>';
task4();
echo '<br>';
echo task5($string1);
echo '<br>';
echo task5($string2);
echo '<br>';
task6('test.txt');