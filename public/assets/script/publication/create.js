document.getElementById('file-upload').addEventListener('change', function(event) {
     const file = event.target.files[0];
     const reader = new FileReader();
   
     reader.onload = function(e) {
       const filePreview = document.getElementById('file-preview');
       filePreview.style.backgroundImage = `url(${e.target.result})`;
     };
   
     if (file) {
       reader.readAsDataURL(file);
     }
   });
   