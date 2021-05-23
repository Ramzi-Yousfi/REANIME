
import 'simplebar'
import 'simplebar/dist/simplebar.css'

const  searchBtn = document.querySelector(".search-btn");
const  search = document.querySelector(".search");
const  close = document.querySelector(".close-search");

let chemin = document.location.pathname;
if (chemin === '/anime' || chemin === '//produit' ){
    searchBtn.addEventListener('click',()=>{
        search.classList.add('search-click');

        searchBtn.classList.add('invisible');


    })
    close.addEventListener('click',()=>{
        search.classList.remove('search-click');
        setTimeout(()=> {
            searchBtn.classList.remove('invisible');
        }, 800);
    })
}
