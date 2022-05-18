<?php
if(isset($_COOKIE["username"]) and isset($_COOKIE["password"])){
  if (($handle = fopen("./users.csv", "r")) !== FALSE) {
    $userId = -1;
    $password = $_COOKIE["password"];
    $username = $_COOKIE["username"];
    while (($data = fgetcsv($handle)) !== FALSE) {
      if (
        ($username == $data[0]) and
        (md5($password) == $data[1])
      ){
        $userId = $data[2];
        break;
      }
    }
    fclose($handle);
  }
  if($userId == -1){
    echo "<p>Une erreur est survenue veuillez vous re connecter a : <a href='./login'>la page de connexion</a></p>";
  }else{
    $alreadyResponded = false;
    if (($handle = fopen("./stats.csv", "r")) !== FALSE) {
      while (($data = fgetcsv($handle)) !== FALSE) {
        if (
          ($userId == $data[0])
        ){
          $alreadyResponded = true;
        }
      }
      fclose($handle);
    }
    if($alreadyResponded){
      echo "Vous avez deja répondu au questionnaire";
    }else{
      if (($handle = fopen("./stats.csv", "a")) !== FALSE) {
        if(isset($_POST["own_animal"])){
          fputcsv($handle, [$userId, round($_POST["age"], 1), $_POST["favorite_color"], "true", $_POST["animal_kind"]]);
        } else {
          fputcsv($handle, [$userId, round($_POST["age"], 1), $_POST["favorite_color"], "false", "none"]);
        }
        echo "Votre réponse a été prit en compte, merci d'avoir bien voulu répondre a notre questionnaire.";
        fclose($handle);
      }
    }
  }
}else {
  echo "<p>Vous n'êtes pas connecté, veuillez vous connecter sur : <a href='./login'>la page de connexion</a></p>";
}
