const modulebutton = document.querySelector('.modulesFolder')


modulebutton.addEventListener('click', ()=>{
    document.querySelector('.Modules').style.display = "block";
    document.querySelector('.folder-container').style.display = 'none'
})
const xbutton = document.querySelector('.xbutton')


xbutton.addEventListener('click', ()=>{
    document.querySelector('.addform').style.display = 'none'
})

const addModules = document.querySelector('.addModules')

addModules.addEventListener('click', ()=>{
    document.querySelector('.addform').style.display = 'block'
})

const otherbutton = document.querySelector(".othersFolder")

otherbutton.addEventListener('click', ()=>{
    document.querySelector(".Others").style.display = "block"
    document.querySelector('.folder-container').style.display = 'none'
})