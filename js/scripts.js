const openBtn=document.getElementById("openModal");
const closeBtn=document.getElementById("closeModal");
const modal=document.getElementById("modal");

openBtn.addEventListener("click",()=>{
    modal.classList.add("open");
});
closeBtn.addEventListener("click",()=>{
    modal.classList.remove("open");
});

const openarticolo=document.getElementById("openModalarticolo");
const closearticolo=document.getElementById("closeModalarticolo");
const modalarticolo=document.getElementById("modalarticolo");

openarticolo.addEventListener("click",()=>{
    modalarticolo.classList.add("open");
});
closearticolo.addEventListener("click",()=>{
    modalarticolo.classList.remove("open");
});