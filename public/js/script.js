const myNav = document.getElementById('myNav');
const navLinks = document.querySelectorAll('#darkLink');

console.log(navLinks);

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
    myNav.classList.remove('menuwhite');
    for(let i = 0; i < navLinks.length; i++){
      navLinks[i].classList.remove('darkLink');
    }
   
  }else {
    menu.classList.add('visible');
    myNav.classList.add('menuwhite');
    for(let i = 0; i < navLinks.length; i++){
      navLinks[i].classList.add('darkLink');
    }
  }
  
}
// fermer le menu
function closeMenu(){
  menu.classList.remove('visible');
  myNav.classList.remove('menuwhite');
  for(let i = 0; i < navLinks.length; i++){
    navLinks[i].classList.remove('darkLink');
  }
}

if(document.getElementById('ingredientContainer')){
  const imgIngredients = document.querySelectorAll('.imgRecipe');
  console.log(imgIngredients);
  
  imgIngredients.forEach(function(i) {
    i.addEventListener('click', function() {
      if(!i.classList.contains('addQuantity')){

       const value = i.childNodes[1].alt;
        
      i.classList.add('addQuantity')
      i.innerHTML += `<label for="${value}">Quantité</label><input type="text" name="${value}" id="${value}"></input>`;
    }
    })
  })
  
}

function darkLink () {
  this.classList.add('darkLink');
}

