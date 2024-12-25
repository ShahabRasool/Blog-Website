<div class="container mx-auto p-4 sm:p-6 lg:p-8">
  <?php include './categories.php'; ?>

  <div class="flex flex-col lg:flex-row gap-8 lg:gap-10">
    <div class="flex-1 flex justify-center items-center border border-red-400 p-6 lg:p-8">
      <h2 class="text-blue-500 text-3xl sm:text-4xl lg:text-5xl first-letter:uppercase font-semibold text-center" id="text">
        Welcome To <?php echo $_SESSION['username'] ?? 'Our Blog'; ?>
      </h2>
    </div>
    <div class="flex-1 flex items-center justify-center lg:justify-end">
      <img class="w-full lg:w-[80%] h-auto object-cover" src="https://drupak.com/sites/default/files/2024-05/Landing%20Page%20image-01.webp" alt="Tech Banner">
    </div>
  </div>

  <div class="flex  gap-6 mt-8">
    <?php include 'publicarticle.php'; ?>
  </div>

  <div class="mt-10 mx-auto bg-white rounded-lg shadow-md p-6 lg:p-8">
    <h1 class="text-2xl sm:text-3xl font-normal mb-4 text-center">What is web development</h1>
    <p class="text-base sm:text-lg pb-6">
      Web development in computer science refers to the creation, building, and maintenance of websites and web applications that are accessed through the internet or an intranet. It encompasses several aspects, including web design, web content development, client-side/server-side scripting, and network security configuration, among other tasks.
    </p>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-xl sm:text-2xl font-semibold mb-4 text-center text-cyan-700">Web Development</h2>
      <table class="min-w-full bg-white border border-gray-300">
        <thead>
          <tr>
            <th class="py-2 px-4 border-b border-gray-300 bg-gray-100 text-left text-gray-600">Frontend Development</th>
            <th class="py-2 px-4 border-b border-gray-300 bg-gray-100 text-left text-gray-600">Backend Development</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="py-2 px-4 border-b border-gray-300">HTML (HyperText Markup Language)</td>
            <td class="py-2 px-4 border-b border-gray-300">Server (Apache, Nginx, Microsoft IIS)</td>
          </tr>
          <tr>
            <td class="py-2 px-4 border-b border-gray-300">CSS (Cascading Style Sheets)</td>
            <td class="py-2 px-4 border-b border-gray-300">Database (MySQL, PostgreSQL, MongoDB, SQLite)</td>
          </tr>
          <tr>
            <td class="py-2 px-4 border-b border-gray-300">JavaScript</td>
            <td class="py-2 px-4 border-b border-gray-300">Server-Side Languages (PHP, Python, Ruby, Java, Node.js)</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
    const textElement = document.getElementById("text");
    const username = "<?php echo $_SESSION['username'] ?? 'Our Blog'; ?>";
    const texts = [username, "a Web Developer"];
    let currentIndex = 0;

    setInterval(() => {
        textElement.classList.add('opacity-0');

        setTimeout(() => {
            currentIndex = (currentIndex + 1) % texts.length;
            textElement.textContent = texts[currentIndex];

            textElement.classList.remove('opacity-0');
        }, 500); 
    }, 3000); 
</script>
