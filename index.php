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
    echo "Bonjour ".$username;
  }
}else {
  echo "<p>Vous n'êtes pas connecté, veuillez vous connecter sur : <a href='./login'>la page de connexion</a></p>";
}
include "./statsform.php";
