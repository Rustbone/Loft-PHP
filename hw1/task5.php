<?php
/**
 * Задание #2

Создайте массив $bmw с ячейками:
model
speed
doors
year
Заполните ячейки значениями соответсвенно: “X5”, 120, 5, “2015”.
Создайте массивы $toyota' и '$opel аналогичные массиву $bmw (заполните данными).
Объедините три массива в один многомерный массив.
Выведите значения всех трех массивов в виде:
CAR name
name ­ model ­speed ­ doors ­ year
Например:
CAR bmw
X5 ­120 ­ 5 ­ 2015
 */

 $bmw = ['model'=>'X5', 'speed'=>120, 'doors'=>5, 'year'=>2015];
 $toyota = ['model'=>'supra', 'speed'=>220, 'doors'=>2, 'year'=>2015];
 $opel = ['model'=>'cadet', 'speed'=>120, 'doors'=>4, 'year'=>2015];

 $cars = ['bmw'=>$bmw, 'toyota'=>$toyota, 'opel'=>$opel];
 foreach ($cars as $key => $value) {
  echo "CAR $key<br>";
  echo "{$value['model']} {$value['speed']} {$value['doors']} {$value['year']}<br><br>";
 }

 // $cars прописать константой const CARS, и в цикле тоже, но не выводиться. Почему?
