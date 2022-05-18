<?php
if(isset($_POST["userName"]) & isset($_POST["password"]) &
  !empty($_POST["userName"]) & !empty($_POST["password"])){
  $userId = -1;
  $username = $_POST["userName"];
  $password = $_POST["password"];
  
  if (($handle = fopen("../users.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
      if (
        ($username == $data[0]) 
      ){
        $userId = $data[2];
      }
    }
    fclose($handle);
  }

  if($userId == -1){
    $userId = count(file('../users.csv'));
    $file = fopen("../users.csv", "a");
    fputcsv($file, [$username, md5($password), $userId]);
    echo "Compte créer avec succès. Bienvenue ".$username.".";
    include("../setUserCookie.php");
    echo "<a href='../'>Voir votre compte ici</a>";
  } else {
    echo "<p>Utilisateur ".$username." déjà existant</p>";
    include("./accountCreationForm.php");
  }
} else {
  include("./accountCreationForm.php");
}
