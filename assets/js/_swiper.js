// import Swiper JS
import SwiperCore, { Navigation, Pagination, Scrollbar,Autoplay } from 'swiper/core';
// Install modules
SwiperCore.use([Navigation, Pagination, Scrollbar,Autoplay]);
// import Swiper styles
import 'swiper/swiper-bundle.css';
import Swiper from "swiper/core";
const swiper = new Swiper(".mySwiper", {
    slidesPerView: 2,
    spaceBetween: 10,
        centeredSlides: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: true,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    loop: true,
    loopFillGroupWithBlank: true,
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 30,
        },
    },
});