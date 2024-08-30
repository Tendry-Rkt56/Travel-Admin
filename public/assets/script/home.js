const menuIcon = document.getElementById('menu-icon')
const navbar = document.querySelector('.navbars')
const boxDifferent = document.querySelectorAll('.box-different')

console.log(boxDifferent)

boxDifferent.forEach((element, index) => {
     element.style.cssText = `
          transition-delay: 0.${index + 2}s
     `
})

console.log(navbar, menuIcon)

menuIcon.addEventListener('click', () => {
     menuIcon.classList.toggle('bx-x')
     navbar.classList.toggle('active')
})