const openMenuIcon = document.getElementById('open-menu');
const menu = document.getElementById('menu');
const closeMenuIcon = document.getElementById('close-menu');

openMenuIcon.addEventListener('click', showMenu);
closeMenuIcon.addEventListener('click', closeMenu)

function showMenu(){
  if(menu.classList.contains('visible')){
    menu.classList.remove('visible');
  }else {
    menu.classList.add('visible');
  }
  
}

function closeMenu(){
  menu.classList.remove('visible');
}



