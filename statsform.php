<script src="index.js" defer></script>
<form action="./saveStats.php" method="post">
  <label for="age">Quelle age avez vous ?</label>
  <input id="age" type="number" name="age" /><br>

  <label for="favorite_color">Quelle est votre couleur préférée ?</label>
  <select name="favorite_color" id="favorite_color">
    <option value="black">Noir</option>
    <option value="gray">Gris</option>
    <option value="green">Vert</option>
    <option value="blue">Bleue</option>
    <option value="red">Rouge</option>
    <option value="purple">Violet</option>
    <option value="pink">Rose</option>
    <option value="yellow">Jaune</option>
    <option value="white">Blanc</option>
    <option value="orange">Orange</option>
  </select><br>

  <label for="own_animal">Possédez vous un animal de compagnie ?</label>
  <input type="checkbox" name="own_animal" id="own_animal"><br>


  <label for="animal_kind" id="animal_kind_label" style="display: none">Quelle genre d'animal ?</label>
  <select name="animal_kind" id="animal_kind" style="display: none">
    <option value="dog">Chien</option>
    <option value="cat">Chat</option>
    <option value="rabbit">Lapin</option>
    <option value="guinea_pig">Cochon d’Inde</option>
    <option value="rat">Rat</option>
    <option value="fish">CochonPoisson</option>
    <option value="snake">Serpent</option>
    <option value="ferret">Furet</option>
    <option value="turtle">Tortue</option>
    <option value="chinchilla">Chinchilla</option>
  </select><br>

  <input type="submit" value="submit" />
</form>
<a href="./login">Cliquez ici pour vous connecter a un autre compte.</a><br>
<a href="./stats.php">Cliquez ici pour voir les statistiques de nos utilisateurs.</a>
