let paso = 1;
const pasoIncial = 1;
const pasoFinal = 3;

document.addEventListener('DOMContentLoaded',function() {
    initApp();
})

function initApp(){
    mostrarSeccion();
    tabs();
    botonesPaginador();
    paginaSiguiente();
    paginaAnterior();
}

function mostrarSeccion() {
    // ocultar si hay una seccion abierta
    const seccionAnterior = document.querySelector('.mostrar');
    if (seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    const seccion = document.querySelector(`#paso-${paso}`);
    seccion.classList.add('mostrar');

    // quitar clase actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }

    // Resaltando el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual')
}


function tabs(){
    const btns = document.querySelectorAll('.tabs button')

    btns.forEach((boton) =>{
        boton.addEventListener('click', function(e){
            paso = parseInt(e.target.dataset.paso)
            console.log(paso);

            mostrarSeccion();
            botonesPaginador();
        })
    })
}

function botonesPaginador(){
    const pagAnterior = document.querySelector('#anterior');
    const pagSiguiente = document.querySelector('#siguiente');

    if(paso === 1){
        pagAnterior.classList.add('ocultar');
        pagSiguiente.classList.remove('ocultar');
    } else if (paso === 3){
        pagAnterior.classList.remove('ocultar');
        pagSiguiente.classList.add('ocultar');
    } else {
        pagAnterior.classList.remove('ocultar');
        pagSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){

        if(paso <= pasoIncial) {
            return;
        }
        paso --;
        botonesPaginador();
    } )
}

function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function(){

        if(paso >= pasoFinal) {
            return;
        }
        paso ++;
        botonesPaginador();
    } )
}