const menuIcon = document.querySelector('.hamburger-menu');
const sidebar = document.querySelector('.sidebar');
const darkbtn = document.querySelector('.dark');
const navColor = document.querySelectorAll('.nav-link');
const cartTable = document.querySelector('.table');
const awsomeColor = document.querySelectorAll('.awsome ');
let chemin = document.location.pathname;
let i ;
let j ;

const body = document.getElementById('body');
menuIcon.addEventListener('click',()=> {
    sidebar.classList.toggle("sidebar-click");
})
darkbtn.addEventListener('click',()=> {
    body.classList.toggle("body-dark");
    sidebar.classList.toggle("sidebar-color");

    if (chemin === '/compte/mes-commande/' ) {
        cartTable.classList.toggle("table-color");
    }
    for (i = 0;i<awsomeColor.length;i++){
        awsomeColor[i].classList.toggle("awsome-color");
    }
})
darkbtn.addEventListener('click',()=> {
for (j = 0;j<navColor.length;j++){
    navColor[j].classList.toggle("nav-color");
}})