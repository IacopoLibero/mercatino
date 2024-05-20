const openBtn=document.getElementById("openModal");
const closeBtn=document.getElementById("closeModal");
const modal=document.getElementById("modal");

openBtn.addEventListener("click",()=>{
    modal.classList.add("open");
});
closeBtn.addEventListener("click",()=>{
    modal.classList.remove("open");
});

function preview() {
    var files = document.querySelector('input[type=file]').files;
    var images = document.getElementById('images');
    var num_of_files = document.getElementById('num-of-files');
    images.innerHTML = '';
    if(num_of_files.innerHTML==1)
        num_of_files.innerHTML = files.length + ' foto selezionate';
    else
        num_of_files.innerHTML = files.length + ' foto selezionata';
    for (var i = 0; i < files.length; i++) {
        var image = document.createElement('img');
        image.src = URL.createObjectURL(files[i]);
        image.style.width = '50%';
        image.style.height = '50%';
        image.style.margin = '10px';
        images.appendChild(image);
    }
}
