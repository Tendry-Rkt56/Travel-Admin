function previewImages() {
     const preview = document.getElementById('preview');
     preview.innerHTML = '';
     const files = document.getElementById('images').files;
     
     if (files) {
         Array.from(files).forEach(file => {
             const reader = new FileReader();
             reader.onload = function(e) {
                 const img = document.createElement('img');
                 img.src = e.target.result;
                 img.style.maxWidth = '150px';
                 img.style.margin = '10px';
                 preview.appendChild(img);
             }
             reader.readAsDataURL(file);
         });
     }
 }