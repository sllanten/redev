console.log("corriendo script Home");
console.log("Api validateCode Nueva manera: ", window.AppData.validateCode);

let datos = [];
let filtrados = [];
let pagina = 1;
const registrosPorPagina = 10;

document.addEventListener("DOMContentLoaded", () => {
    $('#tablaDatos').empty();

    $('#sub').addClass('colorWarnin');

    $('#list').addClass('disabledLink');

    $('#btnExit').addClass('oculto');

    $('#list').removeClass('colorWarnin');


    $('#cod').attr('disabled', false);
    $('#btnSend').attr('disabled', false); 

});

async function sendCode() {
    const codeValue = getCode('cod');
    if (codeValue == "") return;

    try {
        const response = await fetch(window.AppData.validateCode, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ code: codeValue })
        });

        if (!response.ok) {
            throw new Error(`Error del servidor: ${response.status}`);
        }

        const jsonData = await response.json();
        validateResp(jsonData['status'], jsonData['textInfo'])
        if (jsonData['info'] === 403) return;
        if (jsonData['info'].length === 0) msgToast(5);
        datos = jsonData['info'];
        filtrados = [...datos];
        pagina = 1;

        mostrarPagina();

    } catch (error) {
        console.error('Ocurrió un error #1:', error);
    }
}

function validateResp(status, message) {
    if (parseInt(status) == 200) {
        activeApp();
        viewToas(message);
    }

    if (parseInt(status) == 403) {
        document.getElementById('cod').value = "";
        viewToas(message);
    }
}

function activeApp() {
    $('#list').removeClass('disabledLink');
    
    $('#btnExit').removeClass('oculto');

    $('#list').addClass('colorWarnin');

    $('#cod').attr('disabled', true);
    $('#btnSend').attr('disabled', true);

}

function exitApp(){
    $('#tablaDatos').empty();

    document.getElementById('cod').value= "";

    $('#list').addClass('disabledLink');
    
    $('#btnExit').addClass('oculto');

    $('#list').removeClass('colorWarnin');


    $('#cod').attr('disabled', false);
    $('#btnSend').attr('disabled', false); 

}

function test(e) {
    e.preventDefault();
    $('#modaCont').modal('show');
}

const mostrarPagina = () => {
    const inicio = (pagina - 1) * registrosPorPagina;
    const fin = inicio + registrosPorPagina;
    const datosPagina = filtrados.slice(inicio, fin);

    $('#tablaDatos').empty();

    datosPagina.forEach(item => {
        $('#tablaDatos').append(`
            <tr>
                <th scope="row">${item.id}</th>
                <td>${item.red}</td>
                <td>${item.pass}</td>
                <td>${item.fecha}</td>
            </tr>
        `);
    });

    $('#paginaActual').text(pagina);
    $('#anterior').prop('disabled', pagina === 1);
    $('#siguiente').prop('disabled', fin >= filtrados.length);
};

$('#anterior').click(() => {
    if (pagina > 1) {
        pagina--;
        mostrarPagina();
    }
});

$('#siguiente').click(() => {
    if ((pagina * registrosPorPagina) < filtrados.length) {
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
    $('#modaCont').modal('hide');
}