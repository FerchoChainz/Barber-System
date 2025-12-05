document.addEventListener('DOMContentLoaded',function() {
    innitApp()
})

function innitApp(){
    searchByDate();
}

function searchByDate(){
    const dateInput = document.querySelector('#fecha');
    dateInput.addEventListener('input', function(e){
        const datePicked = e.target.value;

        window.location = `?date=${datePicked}`;
    })
}