<?php
if(isset($_POST["userName"]) & isset($_POST["password"])){
  $userId = -1;
  $username = $_POST["userName"];
  $password = $_POST["password"];
  
  if (($handle = fopen("../users.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle)) !== FALSE) {
      if (
        ($username == $data[0]) &
        (md5($password) == $data[1])
      ){
        $userId = $data[2];
      }
    }
    fclose($handle);
  }

  if($userId == -1){
    include("./loginForm.php");
    echo "<p>Utilisateur ".$username." n'as pas été trouvé ou votre mot de passe est incorrecte</p>";
  } else {
    echo "<p>Bienvenue ".$username.".</p>";
    include("../setUserCookie.php");
    echo "<a href='../'>Voir votre compte ici</a>";
  }
} else {
  include("./loginForm.php");
}
