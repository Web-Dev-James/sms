
const addSubject = document.querySelector('.addSubject')
const main = document.querySelector('.main')
const cancelSubject = document.querySelector('.cancelSubject')
const addSubjectDivision = document.querySelector('.addSubjectDivision')
const addsubject = document.querySelector('.addsubject')
const deleteButton = document.querySelector('.deleteButton')

addSubject.addEventListener('click', ()=>{
    main.style.display = 'none'
    addSubjectDivision.style.display = 'block'
})

cancelSubject.addEventListener('click', ()=>{
    main.style.display = 'block'
    addSubjectDivision.style.display = 'none'
})

addsubject.addEventListener('click', ()=>{
    main.style.display = 'block'
    addSubjectDivision.style.display = 'none'
    window.location.reload()
})