const asideIcon = document.querySelector(".toggle")
asideIcon.addEventListener('click', function() {
    const aside = document.querySelector("nav")
    aside.classList.toggle('active')
})

const openModal = document.querySelector(".qrOpen")
openModal.addEventListener('click', function() {
    const modal = document.querySelector("#modal")
    const overlay = document.querySelector('.overlay')
    modal.classList.add('open')
    overlay.classList.add('activate')
})

const closeModal = document.querySelector('.closeModal')

closeModal.addEventListener('click', () => {
    const modal = document.querySelector('#modal')
    modal.classList.remove('open')
    const overlay = document.querySelector('.overlay')
    overlay.classList.remove('activate')
})