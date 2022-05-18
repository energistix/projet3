<?php
$colorsToFr = array(
  "black" => "Noir",
  "gray" => "Gris",
  "green" => "Vert",
  "blue" => "Bleue",
  "red" => "Rouge",
  "purple" => "Violet",
  "pink" => "Rose",
  "yellow" => "Jaune",
  "white" => "Blanc",
  "orange" => "Orange"
);

$animalsToFr = array(
  "dog" => "Chien",
  "cat" => "Chat",
  "rabbit" => "Lapin",
  "guinea_pig" => "Cochon d’Inde",
  "rat" => "Rat",
  "fish" => "CochonPoisson",
  "snake" => "Serpent",
  "ferret" => "Furet",
  "turtle" => "Tortue",
  "chinchilla" => "Chinchilla",
);

function validate($data){
  return $data[1] >= 0 and $data[1] <= 123;
}

if (($handle = fopen("./stats.csv", "r")) !== FALSE) {
  $entries_amount = 0;
  $age_total = 0;
  $age_min = 123;
  $age_max = 0;
  $colorsNums = array(
    "black" => 0,
    "gray" => 0,
    "green" => 0,
    "blue" => 0,
    "red" => 0,
    "purple" => 0,
    "pink" => 0,
    "yellow" => 0,
    "white" => 0,
    "orange" => 0
  );
  $hasAnimalNumber = 0;
  $animalNums = array(
    "dog" => 0,
    "cat" => 0,
    "rabbit" => 0,
    "guinea_pig" => 0,
    "rat" => 0,
    "fish" => 0,
    "snake" => 0,
    "ferret" => 0,
    "turtle" => 0,
    "chinchilla" => 0,
  );

  while (($data = fgetcsv($handle)) !== FALSE) {
    if(validate($data) and isset($colorsNums[$data[2]]) or isset($_GET["ignoredVerif"])){
      $age_total += $data[1];
      $entries_amount += 1;
      if($age_min > $data[1]) $age_min = $data[1];
      if($age_max < $data[1]) $age_max = $data[1];

      if(isset($colorsNums[$data[2]])){
        $colorsNums[$data[2]] += 1;
      }

      if($data[3] == "true" and isset($animalNums[$data[4]])){
        $hasAnimalNumber += 1;
        $animalNums[$data[4]] += 1;
      }
    }
  }
  fclose($handle);

  arsort($colorsNums);
  arsort($animalNums);

  echo "Voici quelques chiffres intéressant sur l'age de nos utilisateurs :<br>";
  echo "L'age moyen est de : " . round($age_total/$entries_amount, 1) . "ans . <br>";
  echo "L'age minimum est de : " . round($age_min) . "ans.<br>";
  echo "L'age maximum est de : " . round($age_max) . "ans.<br>";

  echo "<br>Voici un classement des couleurs préférés de nos utilisateurs :<br>";
  foreach($colorsNums as $key => $value){
    echo $colorsToFr[$key] . " : " . round($value/$entries_amount*100) . "%<br>";
  }

  echo "<br>Voici quelques informations sur les animaux de compagnie de nos utilisateurs :<br>";
  echo round($hasAnimalNumber/$entries_amount*100) . "% de nos utilisateurs possèdent un animal de compagnie.<br>Voici un classement de leurs animaux préférés :<br>";
  foreach($animalNums as $key => $value){
    echo $animalsToFr[$key] . " : " . round($value/$hasAnimalNumber*100) . "%<br>";
  }
}
