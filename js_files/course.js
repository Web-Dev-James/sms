const addCourse = document.querySelector('.addCourse')
const saveCourse = document.querySelector('.saveCourse')
const cancelCourse = document.querySelector('.cancelCourse')

addCourse.addEventListener('click', ()=>{
    document.querySelector('.main').style.display = 'none';
    document.querySelector('.addcourseDivision').style.display = 'block'
})

saveCourse.addEventListener('click', ()=>{
    document.querySelector('.main').style.display = 'block';
    document.querySelector('.addcourseDivision').style.display = 'none'
})

cancelCourse.addEventListener('click', ()=>{
    document.querySelector('.main').style.display = 'block';
    document.querySelector('.addcourseDivision').style.display = 'none'
})