const actions = document.querySelector('.actions')
const dropdown = document.querySelector('.actionsDropdown')


const x = document.querySelector('#buttonX')

x.addEventListener('click', ()=>{
    // document.querySelector('.addform').style.display = "none"
    window.location.href="events.php"
})

const addevents = document.querySelector('.addEvent')


addevents.addEventListener('click', ()=>{
    document.querySelector('.addform').style.display = "block"
    document.body.style.overflow = "hidden"
})

const reset = document.querySelector('#reset')
reset.addEventListener('click', ()=>{
     document.querySelector("#eventdate").value = '';
     document.querySelector("#eventtitle").value = '';
     document.querySelector("#eventbody").value = '';
 })
// saveEvent.addEventListener('click', ()=>{
//     window.location.reload()
// })

// const topnav = document.querySelector('.topnav')

function deletefunction(){
    alert("Event successfully deleted")
}