const sidebar = document.querySelector('.sidebar')
const menuIcon = document.getElementById('menu-icon')

const descriptions = document.querySelectorAll('.description')

if (descriptions) {
     descriptions.forEach(element => {
          element.style.overflow = "auto";
          element.style.scrollbarWidth = "none"; // pour Firefox
          element.style.webkitScrollbar = "none"; // pour Chrome et Safari
     })
}

menuIcon.addEventListener('click', () => {
     menuIcon.classList.toggle('bx-x')
     sidebar.classList.toggle('active')
})