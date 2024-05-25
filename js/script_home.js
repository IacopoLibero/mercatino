const openBtnPrezzo=document.getElementById("openModal-prezzo");
const closeBtnPrezzo=document.getElementById("closeModal-prezzo");
const modalPrezzo=document.getElementById("modal-offerta-prezzo");
openBtnPrezzo.addEventListener("click",()=>{
    modalPrezzo.classList.add("open");
});
closeBtnPrezzo.addEventListener("click",()=>{
    modalPrezzo.classList.remove("open");
});