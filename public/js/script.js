if(document.getElementById('open-menu')){
  openMenuIcon = document.getElementById('open-menu');
  menu = document.getElementById('menu');
  openMenuIcon.addEventListener('click', showMenu);
};
if(document.getElementById('menu')){
  const closeMenuIcon = document.getElementById('close-menu');
  menu = document.getElementById('menu');
  closeMenuIcon.addEventListener('click', closeMenu);
};

// afficher le menu si on clique sur l'icon en haut a gauche
function showMenu(){
  if(menu.classList.contains('visible')){
    menu.classList.remove('visible');
  }else {
    menu.classList.add('visible');
  }
  
}
// fermer le menu
function closeMenu(){
  menu.classList.remove('visible');
}

if(document.getElementById('ingredientContainer')){
  const imgIngredients = document.querySelectorAll('.imgRecipe');
  console.log(imgIngredients);
  
  imgIngredients.forEach(function(i) {
    i.addEventListener('click', function() {
      if(!i.classList.contains('addQuantity')){

       const value = i.childNodes[1].alt;
        
      i.classList.add('addQuantity')
      i.innerHTML += `<label for="quantity${value}">Quantité</label><input type="number" name="quantity${value}"></input><input type="hidden" name="${value}" id="${value}">`;
    }
    })
  })
  
}



