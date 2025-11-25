let paso = 1;
const pasoIncial = 1;
const pasoFinal = 3;

const cita = {
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded',function() {
    initApp();
})

function initApp(){
    mostrarSeccion(); // Muestra y oculta las secciones
    tabs(); // cambia los tabs cuando damos click
    botonesPaginador(); // agrega o quita los botones de anterior o siguiente
    paginaSiguiente();
    paginaAnterior();
    consultarApi(); // consulta la api

    nombreCliente(); // Agrega el nombre del cliente en el objeto
    seleccionarFecha(); // Agrega la fecha en el objeto
    seleccionarHora(); // Agrega la hora en el objeto
    mostrarResumen(); // Muestra el resumen de la cita
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
        mostrarResumen();
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

// consulta API en backend de php 
async function consultarApi(){

    try {
        const url = 'http://localhost:3000/api/services';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);

    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios){
    servicios.forEach((servicio) => {
        const {id, nombre, precio} = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$ ${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function() {
            seleccionServicio(servicio)
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);


    })
}

function seleccionServicio(servicio){
    const {id} = servicio;
    const {servicios} = cita;
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`)

    // check if service is added 
    if(servicios.some(agregado => agregado.id === id )){
        // delete 
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove('seleccionado');
    } else {
        // add
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add('seleccionado');
    }




    console.log(cita);
}

function nombreCliente(){
    const nombre = document.querySelector('#nombre').value;
    cita.nombre = nombre;
    console.log(cita);
}

function seleccionarFecha(){
    const inputFecha = document.querySelector('#fecha');
   inputFecha.addEventListener('input', function(e){

    console.log(e.target.value);

    const dia = new Date(e.target.value).getUTCDay();

    if([6,0].includes(dia)){
        e.target.value = '';
        mostrarAlerta('Fines de semana no permitidos', 'error');
    } else{
        console.log('Correcto');
        cita.fecha = e.target.value;
    }
    console.log(dia);
   }) 
}

// seleccionar hora
function seleccionarHora(){
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e){
        const horaCita = e.target.value;
        const hora= horaCita.split(':')[0];

        if(hora < 10 || hora > 18){
            mostrarAlerta('Hora no válida, debe ser entre 10:00 y 18:00', 'error');
            e.target.value = '';
        } else {
            cita.hora = e.target.value;
            console.log(cita);
        }

        console.log(hora);
    })
}

function mostrarAlerta(mensaje, tipo){
    // previene que se creen varias alertas
    const alertaPrevia = document.querySelector('.alert ');
    if(alertaPrevia) return;

    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alert')
    alerta.classList.add(tipo);

    console.log(alerta);

    const formulario = document.querySelector('#paso-2 p');
    formulario.appendChild(alerta);

    // eliminar alerta despues de 3 segundos
    setTimeout(() => {
        alerta.remove();
    }, 3000);
}

function mostrarResumen(){
    const resumen = document.querySelector('.contenido-resumen');
    
    if(Object.values(cita).includes('')){
        console.log('hacen falta datos');
    } else {
        console.log('todo bien');
    }


}