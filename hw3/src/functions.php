<?php

function task1() {
  $names = ['Иван', 'Саша', 'Мария', 'Катя', 'Аня'];
  // $randomName = $names[array_rand($names)];

  $users = [];

  for ($i = 0; $i < 50; $i++) {
    $user = [
        'id' => $i,
        'name' => $names[array_rand($names)],
        'age' => rand(18, 45)
    ];
    $users[] = $user;
  }

  $jsonData = json_encode($users);
  file_put_contents('users.json', $jsonData);

  $jsonData = file_get_contents('users.json');
  $users = json_decode($jsonData, true);

  $nameCount = array_count_values(array_column($users, 'name'));
  var_dump($nameCount) ;

  $ages = array_column($users, 'age');
  $averageAge = array_sum($ages) / count($ages);
  echo "Средний возраст пользователей: " . $averageAge;
}

