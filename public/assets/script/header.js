const sidebar = document.querySelector('.sidebar')
const menuIcon = document.getElementById('menu-icon')

menuIcon.addEventListener('click', () => {
     menuIcon.classList.toggle('bx-x')
     sidebar.classList.toggle('active')
})