<?php

function task1($array, $return = false) {
  $result = '';
  foreach ($array as $string) {
      $result .= "<p>$string</p>";
  }
  if ($return) {
      return $result;
  } else {
      echo $result;
  }
}

function task2($operation, ...$numbers) {
  switch ($operation) {
      case '+':
          $result = array_sum($numbers);
          break;
      case '-':
          $result = $numbers[0];
          for ($i = 1; $i < count($numbers); $i++) {
              $result -= $numbers[$i];
          }
          break;
      case '*':
          $result = $numbers[0];
          for ($i = 1; $i < count($numbers); $i++) {
              $result *= $numbers[$i];
          }
          break;
      case '/':
          $result = $numbers[0];
          for ($i = 1; $i < count($numbers); $i++) {
              if ($numbers[$i] != 0) {
                  $result /= $numbers[$i];
              } else {
                  return "Ошибка: делить на ноль нельзя";
              }
          }
          break;
      default:
          return "Ошибка: неподдерживаемая операция";
  }
  return $result;
}

function task3($num1, $num2)  {
  if (is_int($num1) && is_int($num2)) {
      echo '<table>';
      for ($i = 1; $i <= $num1; $i++) {
          echo '<tr>';
          for ($j = 1; $j <= $num2; $j++) {
              echo '<td>' . ($i * $j) . '</td>';
          }
          echo '</tr>';
      }
      echo '</table>';
  } else {
      echo 'Ошибка: Переданы некорректные аргументы. Пожалуйста, убедитесь, что оба аргумента являются целыми числами.';
  }
}

function task4() {
  date_default_timezone_set('Europe/Moscow');
  $currentDate = date('d.m.Y H:i');
  $unixTime = strtotime('24.02.2016 00:00:00');
  echo "Текущая дата: $currentDate" . PHP_EOL;
  echo '<br>';
  echo "Unix-время для '24.02.2016 00:00:00': $unixTime";
}

$string1 = 'Карл у Клары украл Кораллы';
$string2 = 'Две бутылки лимонада';
function task5($string) {
  $string = str_replace('К', '', $string);
  $string = str_replace('Две', 'Три', $string);
  return $string;
}

function task6($filename) {
  $file = fopen($filename, 'w');
  fwrite($file, 'Hello again!');
  fclose($file);

  $file = fopen($filename, 'r');
  $content = fread($file, filesize($filename));
  fclose($file);

  echo $content;
}