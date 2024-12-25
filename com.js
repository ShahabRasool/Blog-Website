let btn = document.querySelector('.btn1');
let comment = document.querySelector('.comment'); 
btn.addEventListener("click", function(e) {
    e.preventDefault();
    comment.classList.toggle('hidden');
}); 