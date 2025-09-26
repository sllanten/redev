console.log("corriendo script Home");

let datos = [];
let filtrados = [];
let pagina = 1;
const regPag = 10;

document.addEventListener("DOMContentLoaded", () => {
    resetApp();
});

$('#anterior').click(() => {
    if (pagina > 1) {
        pagina--;
        mostrarPagina();
    }
});

$('#siguiente').click(() => {
    if (pagina * regPag < filtrados.length) {
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

$(document).ready(function () {
    $("#term").on("change", validAcep);
});

function closeMod() {
    $('#modalCont').modal('hide');
}

function test(e) {
    e.preventDefault();
    $('#modalCont').modal('show');
}

function validAcep() {
    if ($("#term").is(":checked")) {
        $("#datos").removeClass("d-none").addClass("d-block");
        $("#nameSub").focus();
    } else {
        $("#datos").removeClass("d-block").addClass("d-none");
    }
}

function exitApp() {
    $('#tablaDatos').empty();
    $('#cod').val('');
    toggleAppState(false);
}

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

        validRequest(status,textInfo,info);

    } catch (error) {
        console.error('Error en sendCode:', error);
    }
}

function validRequest(status, texto, data){
    const s = parseInt(status);
    
    if (s == 200 && Array.isArray(data)) {
        
        toggleAppState(true);

        datos = [...data];
        filtrados = [...datos];
        pagina = 1;
        mostrarPagina();

        setTimeout(() => {
            $('#modalCont').modal('show');
        }, 2000);
    }

    if (s == 200 && !Array.isArray(data)) {
        toggleAppState(true);
    }

    if (s == 404) {
        
        $('#term').prop('checked', false);
        $('#nameSub').val('');
        $('#celSub').val('');
        
        toggleAppState(true);
    } 

    if (s == 401) $('#cod').val('');

    viewToas(texto);

}

function mostrarPagina() {
    const inicio = (pagina - 1) * regPag;
    const fin = inicio + regPag;
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

function valiSub(){

    let dataNom = document.getElementById('nameSub').value;
    let dataCel = document.getElementById('celSub').value ;
    if ($("#term").is(":checked") && dataNom && dataCel) {
        
        $('#modalSus').modal('hide');
        sendSoli(dataNom,cifrarCode(dataCel));

    } else {
        msgToast(11);
        $("#nameSub").focus();
    }
}

async function sendSoli(nom,num){
    try {
        const response = await fetch(window.AppData.soliSub, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                cliente: nom,
                celular: num
            })
        });

        if (!response.ok) throw new Error(`Error servidor: ${response.status}`);

        const jsonData = await response.json();

        if (jsonData['status'] == 200) msgToast(27);
        if (jsonData['status'] == 401) msgToast(30);
        if (jsonData['status'] == 409) msgToast(34);

    } catch (error) {
        console.error('Error en soliSub:', error);
    }
}