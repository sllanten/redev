console.log("corriendo script Admin");
console.log("Api getEndpointApi: ", window.AppData.getEndpointApi);
console.log("Api getMessage: ", window.AppData.getMessage);
console.log("Api updateMsg: ", window.AppData.updateMsg);

let idEditMessage=0;
let datosMessage = [];
let filtradoMessage = [];
let paginaMessage = 1;
const regPagMessage = 10;
let contReg2 = 0;

let datosEndPoint = [];
let filtradoEndPoint = [];
let paginaEndPoint = 1;
const regPagEndPoint = 10;
let contReg=0;

$(document).ready(function () {
    getMessage();
    getEndPoint();
});

async function getMessage() {
    try {
        const response = await fetch(window.AppData.getMessage, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`Error del servidor2: ${response.status}`);
        }

        const jsonData = await response.json();

        datosMessage = jsonData;
        filtradoMessage = [...datosMessage];
        paginaMessage = 1;

        mostrarMessage();

    } catch (error) {
        console.error('Ocurrió un error #2:', error);
    }
}

const mostrarMessage = () => {
    const inicio = (paginaMessage - 1) * regPagEndPoint;
    const fin = inicio + regPagMessage;
    const datosPagina = filtradoMessage.slice(inicio, fin);


    $('#tablaDatos').empty();

    datosPagina.forEach(item => {
        contReg2++
        $('#tablaDatos').append(`
            <tr>
                <th scope="row">${contReg2}</th>
                <td>${item.mensaje}</td>
                <td><span class="${item.class}">${item.tipo}</span></td>
                <td>
                    <button class="devBtn btn btn-sm btn-warning text-white" onclick="verMsg('${item.id}','${item.mensaje}','${item.tipo}')">Editar</button>
                    &nbsp
                    <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="canEdit(${item.id})">Eliminar</button>
                </td>
            </tr>
        `);
    });

    $('#paginaActual').text(paginaMessage);
    $('#btnTableAnt').prop('disabled', paginaMessage === 1);
    $('#btnTableSig').prop('disabled', fin >= filtradoMessage.length);
};

$('#btnTableAnt').click(() => {
    if (paginaMessage > 1) {
        paginaMessage--;
        resetLIst2();
        mostrarMessage();
    }
});

$('#btnTableSig').click(() => {
    if ((paginaMessage * regPagMessage) < filtradoMessage.length) {
        paginaMessage++;
        mostrarMessage();
    }
});

$('#filtroNombre').on('input', () => {
    const filtro = $('#filtroNombre').val().toLowerCase();
    filtradoMessage = datosMessage.filter(item => item.mensaje.toLowerCase().includes(filtro));
    paginaMessage = 1;
    resetLIst2();
    mostrarMessage();
});

function resetLIst2() {
    contReg2 = 0;
}

function verMsg(id, msg, tipo) {
    idEditMessage = parseInt(id);
    document.getElementById('editMessage').value = msg;
    document.getElementById('tipoEdit').value = tipo;

    const select = document.getElementById('EditselectType');
    select.innerHTML = ""; 

    const opciones = [
        { value: "badge bg-secondary", text: "Sistema" },
        { value: "badge bg-primary", text: "Suscripcion" },
        { value: "badge bg-primary", text: "List Dark" }
    ];

    opciones.forEach(op => {
        const option = document.createElement("option");
        option.value = op.value;
        option.textContent = op.text;

        if (op.text === tipo) {  
            option.selected = true;
        }

        select.appendChild(option);
    });

    $('#modalEditMessage').modal('show');
}

function validMsgEdit(){
    $('#modalEditMessage').modal('hide');
    let id = parseInt(document.getElementById('idEditMessage'));
    let msg = document.getElementById('editMessage').value;
    let tipo = document.getElementById('tipoEdit').value;
    let clase = document.getElementById('EditselectType').value;

    event.preventDefault()

    if (id > 0 || msg.trim() || tipo.trim() || clase.trim()) {
        msgToast(11);
    }else{
        updateMsg(id, msg, tipo, clase) ;
    }
}

async function updateMsg(id,msg,tipo,clase) {
    try {
        const response = await fetch(window.AppData.updateMsg, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id,
                msg: msg,
                tipo: tipo,
                class: clase
            })

        });

        if (!response.ok) {
            throw new Error(`Error del servidor Api #4: ${response.status}`);
        }

        const jsonData = await response.json();
        jsonData['status'] === 200 ? msgToast(16) : msgToast(18);

        canEdit();

        contReg2=0;
        contReg=0;
        getMessage();
        getEndPoint();

    } catch (error) {
        console.error('Ocurrió un error Api #4:', error);
    }
}

function canEdit() {
    idEditMessage = 0;
}

async function getEndPoint() {
    try {
        const response = await fetch(window.AppData.getEndpointApi, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`Error del servidor: ${response.status}`);
        }

        const jsonData = await response.json();

        datosEndPoint = jsonData;
        filtradoEndPoint = [...datosEndPoint];
        paginaEndPoint = 1;

        mostrarEndPoint();

    } catch (error) {
        console.error('Ocurrió un error #1:', error);
    }
}

const mostrarEndPoint = () => {
    const inicio = (paginaEndPoint - 1) * regPagEndPoint;
    const fin = inicio + regPagEndPoint;
    const datosPagina = filtradoEndPoint.slice(inicio, fin);


    $('#tablaDatos2').empty();

    datosPagina.forEach(item => {
        contReg++
        $('#tablaDatos2').append(`
            <tr>
                <th scope="row">${contReg}</th>
                <td>${item.nombre}</td>
                <td>${item.descripcion}</td>
                <td>${item.url}</td>
                <td>
                    <button class="devBtn btn btn-sm btn-warning text-white" onclick="verSubs(${item.id})">Editar</button>
                    &nbsp
                    <button class="devBtn btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="canEdit(${item.id})">Eliminar</button>
                </td>
            </tr>
        `);
    });

    $('#paginaActual2').text(paginaEndPoint);
    $('#btnTableAnt2').prop('disabled', paginaEndPoint === 1);
    $('#btnTableSig2').prop('disabled', fin >= filtradoEndPoint.length);
};

$('#btnTableAnt2').click(() => {
    if (paginaEndPoint > 1) {
        paginaEndPoint--;
        resetLIst();
        mostrarEndPoint();
    }
});

$('#btnTableSig2').click(() => {
    if ((paginaEndPoint * regPagEndPoint) < filtradoEndPoint.length) {
        paginaEndPoint++;
        mostrarEndPoint();
    }
});

$('#filtroNombre2').on('input', () => {
    const filtro = $('#filtroNombre2').val().toLowerCase();
    filtradoEndPoint = datosEndPoint.filter(item => item.nombre.toLowerCase().includes(filtro));
    paginaEndPoint = 1;
    resetLIst();
    mostrarEndPoint();
});

function resetLIst() {
    contReg = 0;
}
