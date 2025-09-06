console.log("corriendo script Home");

let datos = [];
let filtrados = [];
let pagina = 1;
const registrosPorPagina = 10;

document.addEventListener("DOMContentLoaded", () => {
    resetApp();
});

$(document).ready(function () {
    $("#term").on("change", validAcep);
});

async function sendCode() {
    const codeValue = getCode('cod').trim();
    if (!codeValue) return;

    try {
        const response = await fetch(window.AppData.validateCode, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ code: codeValue })
        });

        if (!response.ok) throw new Error(`Error servidor: ${response.status}`);

        const { status, textInfo, info } = await response.json();

        validateResp(status, textInfo);

        if (status == 403 || !Array.isArray(info)) return;

        if (!info.length) return msgToast(5);

        datos = [...info];
        filtrados = [...datos];
        pagina = 1;
        mostrarPagina();
        
        loadList();

    } catch (error) {
        console.error('Error en sendCode:', error);
    }
}

function validateResp(status, message) {
    status = parseInt(status);
    if (status === 200) {
        activeApp();
    } else if (status === 403) {
        $('#cod').val('');
    }
    viewToas(message);
}

function activeApp() {
    toggleAppState(true);
}

function exitApp() {
    $('#tablaDatos').empty();
    $('#cod').val('');
    toggleAppState(false);
}

function toggleAppState(isActive) {
    $('#list').toggleClass('disabledLink', !isActive)
        .toggleClass('colorWarnin', isActive);

    $('#btnExit').toggleClass('oculto', !isActive);

    $('#cod, #btnSend').prop('disabled', isActive);
}

function resetApp() {
    $('#tablaDatos').empty();
    $('#sub').addClass('colorWarnin');
    $('#list').addClass('disabledLink').removeClass('colorWarnin');
    $('#btnExit').addClass('oculto');
    $('#cod, #btnSend').prop('disabled', false);
}

function test(e) {
    e.preventDefault();
    $('#modalCont').modal('show');
}

function mostrarPagina() {
    const inicio = (pagina - 1) * registrosPorPagina;
    const fin = inicio + registrosPorPagina;
    const datosPagina = filtrados.slice(inicio, fin);

    $('#tablaDatos').html(datosPagina.map(item => `
        <tr>
            <th scope="row">${item.id}</th>
            <td>${item.red}</td>
            <td>${descifrarAES(item.pass)}</td>
            <td>${item.fecha}</td>
        </tr>
    `).join(''));

    $('#paginaActual').text(pagina);
    $('#anterior').prop('disabled', pagina === 1);
    $('#siguiente').prop('disabled', fin >= filtrados.length);
}

$('#anterior').click(() => {
    if (pagina > 1) {
        pagina--;
        mostrarPagina();
    }
});

$('#siguiente').click(() => {
    if (pagina * registrosPorPagina < filtrados.length) {
        pagina++;
        mostrarPagina();
    }
});

$('#filtroNombre').on('input', () => {
    const filtro = $('#filtroNombre').val().toLowerCase();
    filtrados = datos.filter(item => item.red.toLowerCase().includes(filtro));
    pagina = 1;
    mostrarPagina();
});

function closeMod() {
    $('#modalCont').modal('hide');
}

function loadList() {
    setTimeout(() => {
        $('#modalCont').modal('show');
    }, 2000);
}

function validAcep() {
    if ($("#term").is(":checked")) {
        $("#datos").removeClass("d-none").addClass("d-block");
        $("#nameSub").focus();
    } else {
        $("#datos").removeClass("d-block").addClass("d-none");
    }
}

function valiSub(){

    let dataNom = document.getElementById('nameSub').value;
    let dataCel = document.getElementById('celSub').value ;
    if ($("#term").is(":checked") && dataNom && dataCel) {
        $('#modalSus').modal('hide');
        viewToas("Su suscripcion esta pendiente por validar")
    } else {
        msgToast(11);
        $("#nameSub").focus();
    }
}