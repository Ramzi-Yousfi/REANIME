const menuIcon = document.querySelector('.hamburger-menu');
const sidebar = document.querySelector('.sidebar');
const nav =document.querySelector('.nav-list')


menuIcon.addEventListener('click',()=> {
    sidebar.classList.toggle("sidebar-click");
})
nav.addEventListener('click',()=>{
    sidebar.classList.toggle("sidebar-click");
})