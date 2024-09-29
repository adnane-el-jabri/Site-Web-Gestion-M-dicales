const asideIcon = document.querySelector(".toggle")
asideIcon.addEventListener('click', function() {
    const aside = document.querySelector("nav")
    aside.classList.toggle('active')
})