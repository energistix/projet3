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

if (($handle = fopen("./stats.csv", "r")) !== FALSE) {

  include("jpgraph-4.4.1/src/jpgraph.php");
  include("jpgraph-4.4.1/src/jpgraph_pie.php");

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

  function validate($data){
    return $data[1] >= 0 and $data[1] <= 123;
  }

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

  $tableau = [];
  $legends = [];
  
  foreach($animalNums as $key => $value){
    if($value!==0){
      array_push($tableau, round($value/$hasAnimalNumber*100));
      array_push($legends, $animalsToFr[$key]);
    }
  }

  $diagram = new PieGraph(400,350);
  $cercle = new PiePlot($tableau);
  $cercle->SetCenter(0.4);
  $cercle->SetValueType(PIE_VALUE_ABS);
  $cercle->value->SetFormat("%d");
  $cercle->SetLegends($legends);
  $diagram->Add($cercle);
  $diagram->Stroke();
}