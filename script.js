function consultarInformacion() {
    // Aquí puedes realizar una llamada a la API para obtener datos
    // Supongamos que obtienes los datos de la API en un formato similar a esto
    const datosCircuitos = [
        { id: 1, campo1: 'valor1', campo2: 'valor2' },
        { id: 2, campo1: 'valor3', campo2: 'valor4' },
        // ... Agrega más datos según tu estructura
    ];

    // Crear un formulario dinámicamente
    const form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', 'consultar.html');

    // Crear un campo de entrada oculto para enviar datos al formulario
    const inputDatos = document.createElement('input');
    inputDatos.setAttribute('type', 'hidden');
    inputDatos.setAttribute('name', 'datosCircuitos');
    inputDatos.setAttribute('value', JSON.stringify(datosCircuitos));
    form.appendChild(inputDatos);

    // Agregar el formulario al cuerpo del documento y enviarlo
    document.body.appendChild(form);
    form.submit();
}

function actualizarInformacion() {
    // Aquí puedes realizar una llamada a la API para obtener datos a actualizar
    console.log("Actualizar información");

    // Supongamos que tienes algunos datos para enviar al formulario
    const datosActualizar = {
        campo1: 'valor1',
        campo2: 'valor2'
    };

    // Crear un formulario dinámicamente
    const form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', 'actualizar.html');

    // Crear campos de entrada para cada dato
    for (const key in datosActualizar) {
        if (datosActualizar.hasOwnProperty(key)) {
            const input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', key);
            input.setAttribute('value', datosActualizar[key]);
            form.appendChild(input);
        }
    }

    // Agregar el formulario al cuerpo del documento y enviarlo
    document.body.appendChild(form);
    form.submit();
}

function visualizarInformacion() {
    // Aquí puedes realizar una llamada a la API para visualizar información
    console.log("Visualizar información");
}
function obtenerCoordenadas() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            document.getElementById('coordenadas').value = position.coords.latitude + ', ' + position.coords.longitude;
            alert('Coordenadas obtenidas correctamente.');
        }, function (error) {
            alert('Error al obtener las coordenadas: ' + error.message);
        });
    } else {
        alert('Tu navegador no soporta la geolocalización.');
    }
}

function guardarCoordenadas() {
    document.getElementById('coordenadas').readOnly = true; // Hacer el campo de coordenadas no editable
    alert('Coordenadas guardadas correctamente.');
}

function enviarFormulario() {
    // Puedes agregar aquí la lógica para enviar los datos del formulario
    // Por ejemplo, puedes usar AJAX para enviar los datos a un servidor.
    alert("Formulario enviado correctamente");
}
