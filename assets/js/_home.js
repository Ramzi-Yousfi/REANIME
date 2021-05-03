


import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
import EasePack from "gsap/EasePack";
const translate = document.querySelectorAll(".translate");
const x = document.querySelector('.lune');
const y = document.querySelector('.lune-rouge');
const logo1 = document.querySelector('.logo');



window.addEventListener('scroll',()=>{
    let scroll = window.pageYOffset;

    translate.forEach(element=>{
        let speed = element.dataset.speed;
        element.style.transform = `translateY(${scroll * speed}px)`;
    })

    function changeImage()
    {
        if(scroll >= 200){
            x.classList.add('hidden')
            y.classList.add('show');
        }else{
            y.classList.remove('show');
            x.classList.remove('hidden')
        }
    }
    changeImage();

})
window.addEventListener('load',()=>{
 gsap.from(logo1, { duration: 5,ease:'bounce.out',x:-200 });
})
gsap.registerPlugin(ScrollTrigger,EasePack);
gsap.from(".hhhh",{
    scrollTrigger:{
        trigger:".hhhh",
        start:"20px 80%",
        toggleActions:"restart none none none"
    },
    x:-200,
    rotateY:-50,
    opacity:0,
    duration:4,
});
gsap.from(".selection1-home-img",{
    scrollTrigger:{
        trigger:".selection1-home-img",
        start:"20px 100%",
        toggleActions:"restart none none none"
    },
    x:-1000,
    rotateY:-50,
    opacity:0,
    duration:4,
});

gsap.from(".selection1-home-text",{
    scrollTrigger:{
        trigger:".selection1-home-text",
        start:"20px 100%",
        toggleActions:"restart none none none"
    },
    x:1000,
    rotateY:50,
    opacity:0,
    duration:4,
});

