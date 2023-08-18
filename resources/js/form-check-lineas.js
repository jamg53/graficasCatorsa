
const checkbox = document.getElementById('Check1');
const almacenesSelect = document.getElementById('selectAlmacen');

const checkbox2 = document.getElementById('Check2');
const checkbox2Hoy = document.getElementById('Check2hoy');
const fechaInicioInput = document.getElementById('fechaIncio');
const fechaFinalInput = document.getElementById('fechaFinal');

const checkbox3 = document.getElementById('Check3');
const horaInicioInput = document.getElementById('horaInicio');
const horaFinalInput = document.getElementById('horaFinal');

checkbox.addEventListener('change', function () {
    if (this.checked) {
        almacenesSelect.disabled = true;
        almacenesSelect.value = '';


    } else {
        almacenesSelect.disabled = false;
    }
});

checkbox2.addEventListener('change', function () {
    if (this.checked) {
        fechaInicioInput.disabled = true;
        fechaFinalInput.disabled = true;
        checkbox2Hoy.disabled = true;

        if (checkbox2Hoy.checked) {

            checkbox2Hoy.checked = false;
            fechaFinalInput.value = '';

        }

    } else {
        fechaInicioInput.disabled = false;
        fechaFinalInput.disabled = false;
        checkbox2Hoy.disabled = false;

    }
});

checkbox3.addEventListener('change', function () {
    if (this.checked) {
        horaInicioInput.disabled = false;
        horaFinalInput.disabled = false;


    } else {
        horaInicioInput.disabled = true;
        horaFinalInput.disabled = true;
    }
});

checkbox2Hoy.addEventListener('change', function () {
    if (this.checked) {

        setFechaHoy();

    } else {
        fechaFinalInput.value = '';
        fechaFinalInput.readOnly = false;

    }
});

function setFechaHoy() {

    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const fechaActual = `${year}-${month}-${day}`;
    fechaFinalInput.value = fechaActual;
    fechaFinalInput.readOnly = true;

}

$(function () {
    $("#fechaIncio").datepicker({
        dateFormat: "yy-mm-dd",
        altFormat: "yy-mm-dd"
    });
    $("#fechaFinal").datepicker({
        dateFormat: "yy-mm-dd",
        altFormat: "yy-mm-dd"
    });
});

$(function () {
    $("#horaInicio").timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        minTime: '08:00',
        maxTime: '20:00',
        defaultTime: '08:00',
        startTime: '08:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
});

$(function () {
    $("#horaFinal").timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        minTime: '08:00',
        maxTime: '20:00',
        defaultTime: '20:00',
        startTime: '08:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
});


