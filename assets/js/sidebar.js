const menuIcon = document.querySelector('.hamburger-menu');
const sidebar = document.querySelector('.sidebar');


menuIcon.addEventListener('click',()=>{
    sidebar.classList.toggle("sidebar-click")
});
