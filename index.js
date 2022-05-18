const ownAnimal = document.getElementById("own_animal")
function ownAnimalChangeListener() {
  ;["animal_kind", "animal_kind_label"].forEach((id) => {
    document.getElementById(id).style.display = ownAnimal.checked ? "inline" : "none"
  })
}

ownAnimal.addEventListener("change", ownAnimalChangeListener)
ownAnimalChangeListener()
