<form action="" id="formdata" method="post" class="w-[60%]  mx-auto py-3 ">
    <div class="relative">
        <input type="search" id="searchbox" name="searchtitle" placeholder="Search articles..."
            class="w-[40%] p-3 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent shadow-sm">
        
        <div id="suggest" class="absolute left-0 right-0 bg-white border-gray-300 rounded-lg shadow-lg mt-2 w-[40%]">
            
        </div>
    </div>
  
</form>

<script>
   let formData = document.querySelector('#formdata');
let searchBox = document.querySelector("#searchbox");
let suggest = document.querySelector("#suggest");

searchBox.addEventListener('keyup', function(e) {
    e.preventDefault();
    // console.log(e.target.value);
 let data = e.target.value; 

    let xhr = new XMLHttpRequest();

    xhr.open('POST', 'searchhearder.php' );

    xhr.onload = function() { 
        if (xhr.status === 200 && xhr.readyState === 4) {
       
            suggest.innerHTML = xhr.responseText;  
        }
    };

    let form = new FormData(formData); 
    xhr.send(form);
});

</script>