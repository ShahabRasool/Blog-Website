let allLinks = document.querySelectorAll(".ajexlink");

allLinks.forEach(function(link) {
    link.addEventListener("click", function(event) {
        event.preventDefault();
        let id = event.target.dataset.aid;
        let div = document.querySelector('.root');
        div.innerHTML = "loading.....";
        
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'dumny.php?a_id=' + id);
        
        xhr.onload = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let obj = JSON.parse(xhr.responseText);
                
                div.innerHTML = `
                    <div class="card">
                        <h2 class="text-2xl font-bold text-white">${obj.title}</h2>
                        <p class="text-1xl text-white">${obj.description}</p>
                        <div class="flex flex-col">
                            <h1 class="text-2xl text-white first-letter:uppercase">Author: ${obj.name}</h1>
                            <p class="text-1xl text-white">${obj.submited}</p>
                            <p class="text-1xl text-white">Category: ${obj.c_name}</p>
                        </div>
                    </div>
                `;
                let commentDiv = document.querySelector('.comment');
                if (obj.comments) {
                    commentDiv.innerHTML = obj.comments;  // Assuming the comments HTML is returned
                } else {
                    commentDiv.innerHTML = '<p>No comments available.</p>';
                }
                
                // Update the comment form with the correct article ID
                let commentForm = document.querySelector('#commentForm');
                commentForm.action = 'maintamplete.php?page=artical&a_id=' + id;
                commentForm.querySelector('input[name="a_id"]').value = id;
            }
        };
        
        xhr.send();
    });
});
    