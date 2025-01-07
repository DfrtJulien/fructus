const myNav = document.getElementById('myNav');
const navLinks = document.querySelectorAll('#darkLink');


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

if(document.body.clientWidth > 1200) {

window.addEventListener('scroll', function(e) {
  if(document.getElementById('arrowUp')){

  const arrowUp = this.document.getElementById('arrowUp');
  let scrollPosition = window.scrollY;
  arrowUp.style.opacity = "1";
  if(scrollPosition >= 400){
    let top = window.scrollY
    let calc = top + 350;
    arrowUp.style.top = `${calc}px`;
    myNav.classList.add('animationNav');
  } else {
    myNav.classList.remove('animationNav');
    arrowUp.style.opacity = "0";
  }
  }
 
  });
} else {

  window.addEventListener('scroll', function(e) {
    let scrollPosition = window.scrollY;
    if(scrollPosition >= 400){
      myNav.style.transition = "all 0.5s"
      myNav.style.backgroundColor = "#F88838";
      
    } else {
      myNav.style.backgroundColor = "transparent";
    }
    });
}