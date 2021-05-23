const star1 = document.querySelector('.star1')
const star2 = document.querySelector('.star2')
const KeyBoard = document.querySelector('.input-key')
const urlcourante = document.location.href;

var chemin = document.location.pathname;
if (chemin ==='/connexion'){
    KeyBoard.addEventListener('keydown',()=>{
      star1.classList.add('rotate-left');
      star1.classList.add('move');
      star2.classList.add('rotate-right');
    })

}



