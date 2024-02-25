function validarNic() {
    var nicValidar = document.getElementById('nicValidar').value;

    if (nicValidar.trim() !== "") {
        obtenerInformacionPorNIC(nicValidar);
    } else {
        alert("Por favor, ingrese un NIC válido.");
    }
}
function obtenerInformacionPorNIC(nic) {
    // Make an AJAX request
    $.ajax({
        type: 'POST',
        url: 'conn.php', // Replace with the actual file handling the database query
        data: { nicValidar: nic }, // Send nicValidar as POST data
        dataType: 'json', // Expect JSON response
        success: function(response) {
            // Handle the JSON response and update the input fields
            if (response.error) {
                alert(response.error);
            } else {
                // Update the fields in the "actualizar" view
                $('#mt1').text(response.MT);
                $('#ct1').text(response.CT);
                $('#medidor1').text(response.NIC);
                $('#nic1').text(response.NIC);
                $('#mc1').text(response.MC);
                $('#territorio1').text(response.TERRITORIO);
                $('#codigo_sic1').text(response.CODIGO_SIC);
                $('#nombre1').text(response.NOMBRE);
                $('#lat_def1').text(response.LAT_DEF);
                $('#long_def1').text(response.LONG_DEF);
                $('#circuito1').text(response.CIRCUITO);

                // You may also perform other actions or logic here based on the response
            }
        },
        error: function(error) {
            console.error('Error in AJAX request:', error);
        }
    });
}


function obtenerYGuardarCoordenadas() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var coordenadasInput = document.getElementById('coordenadas');
            coordenadasInput.value = position.coords.latitude + ', ' + position.coords.longitude;
            coordenadasInput.readOnly = true;
            alert('Coordenadas obtenidas y guardadas correctamente.');
        }, function (error) {
            alert('Error al obtener las coordenadas: ' + error.message);
        });
    } else {
        alert('Tu navegador no soporta la geolocalización.');
    }
}


function guardarYMostrarFecha() {
  var currentDate = new Date();
  var formattedDate = currentDate.toLocaleString('es-ES');
  document.getElementById('currentDate').value = formattedDate;
    
}


function formatoNombre() {
  var inputNombre = document.getElementById('fullName');
  var nombre = inputNombre.value.toLowerCase();
  nombre = nombre.normalize('NFD').replace(/[\u0300-\u036f]/g, ''); // Eliminar acentos
  nombre = nombre.replace(/[^a-z]/g, ''); // Eliminar caracteres no alfabéticos
  inputNombre.value = nombre;
}

function enviarFormulario() {
    var nicValidar = document.getElementById('nicValidar').value;
    var territorio = document.getElementById('territorio').value;
    var codigo_sic = document.getElementById('codigo_sic').value;
    var nombre = document.getElementById('nombre').value;
    var lat_def = document.getElementById('lat_def').value;
    var long_def = document.getElementById('long_def').value;
    var coordenadas = document.getElementById('coordenadas').value;
    var fullName = document.getElementById('fullName').value;
    var currentDate = document.getElementById('currentDate').value;
    var actividadComercial = document.getElementById('actividadComercial').value;
    var tipoMedida = document.getElementById('tipoMedida').value;
    var ubicacionMedida = document.getElementById('ubicacionMedida').value;
    var kvaEncontrado = document.getElementById('kvaEncontrado').value;
    var resultadoInspeccion = document.getElementById('resultadoInspeccion').value;
    var novedadEncontrada = document.getElementById('novedadEncontrada').value;
    var requiereRevision = document.getElementById('requiereRevision').value;
    var tipoLector = document.getElementById('tipoLector').value;
    var observaciones = document.getElementById('observaciones').value;

    var status = "exitoso";

    if (
        nicValidar === '' || territorio === '' || codigo_sic === '' || nombre === '' ||
        lat_def === '' || long_def === '' || coordenadas === '' || fullName === '' ||
        currentDate === '' || actividadComercial === '' || tipoMedida === '' ||
        ubicacionMedida === '' || kvaEncontrado === '' || resultadoInspeccion === '' ||
        (resultadoInspeccion === 'NoConforme' && novedadEncontrada === '') ||
        requiereRevision === '' || (requiereRevision === 'Si' && tipoLector === '')
    ) {
        status = "Rellena los campos";
        alert('Por favor, completa todos los campos antes de enviar el formulario.');
    } else {
        // Hacer la solicitud AJAX para enviar los datos a la base de datos
        $.ajax({
            type: 'POST',
            url: 'procesar_formulario.php',
            data: {
                nicValidar: nicValidar,
                coordenadas: coordenadas,
                fullName: fullName,
                currentDate: currentDate,
                actividadComercial: actividadComercial,
                tipoMedida: tipoMedida,
                ubicacionMedida: ubicacionMedida,
                kvaEncontrado: kvaEncontrado,
                resultadoInspeccion: resultadoInspeccion,
                novedadEncontrada: novedadEncontrada,
                requiereRevision: requiereRevision,
                tipoLector: tipoLector,
                observaciones: observaciones
            },
            success: function(response) {
                alert('Datos guardados en la base de datos correctamente.');
                // Puedes realizar más acciones aquí según sea necesario
            },
            error: function(error) {
                console.error('Error al enviar datos a la base de datos:', error);
                alert('Error al enviar datos a la base de datos. Por favor, inténtalo de nuevo.');
            }
        });
    }

    alert('Status del formulario: ' + status);
}

function mostrarNovedades() {
    var resultadoInspeccion = document.getElementById("resultadoInspeccion");
    var novedadEncontrada = document.getElementById("novedadEncontrada");

    if (resultadoInspeccion.value === "NoConforme") {
        novedadEncontrada.style.display = "block";
    } else {
        novedadEncontrada.style.display = "none";
    }
}

function mostrarTipoLector() {
    var requiereRevision = document.getElementById("requiereRevision");
    var tipoLectorLabel = document.getElementById("labelTipoLector");
    var tipoLectorSelect = document.getElementById("tipoLector");

    if (requiereRevision.value === "Si") {
        tipoLectorLabel.style.display = "block";
        tipoLectorSelect.style.display = "block";
    } else {
        tipoLectorLabel.style.display = "none";
        tipoLectorSelect.style.display = "none";
    }
}





