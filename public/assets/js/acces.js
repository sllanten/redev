console.log("corriendo script AccesNode");
console.log("Api Cliente", window.AppData.getCliente);
console.log("Api Suscripcion", window.AppData.getSubs);
console.log("Api ListDark", window.AppData.getOnlyRedes);
console.log("Api DeleteSub", window.AppData.deleteSub);
console.log("Api createSubs", window.AppData.createSubs);

let datosClient = [];
let filtradosClient = [];
let paginaClient = 1;
const regPagClient = 10;

let datosSub = [];
let filtradosSub = [];
let paginaSub = 1;
const regPagSub = 10;

let datosRed = [];
let filtradosRed = [];
let paginaRed = 1;
const regPagRed = 10;

let idDelSub = 0;
let idDelUser = 0;

const selected = [];
let contReg= 0;

$(document).ready(function () {
    getUser();
});

async function getSubs(id) {
    try {
        const response = await fetch(window.AppData.getSubs, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ code: id })
        });

        if (!response.ok) {
            throw new Error(`Error del servidor: ${response.status}`);
        }

        const jsonData = await response.json();
        if (jsonData['data'].length === 0) msgToast(8);

        datosSub = jsonData['data'];
        filtradosSub = [...datosSub];
        paginaSub = 1;

        mostrarSubs();
        
        $('#modalList').modal('show');


    } catch (error) {
        console.error('Ocurrió un error #1:', error);
    }
}

const mostrarSubs = () => {
    const inicio = (paginaSub - 1) * regPagSub;
    const fin = inicio + regPagSub;
    const datosPagina = filtradosSub.slice(inicio, fin);

    $('#tablaDatos2').empty();

    datosPagina.forEach(item => {
        contReg++
        $('#tablaDatos2').append(`
            <tr>
                <th scope="row">${contReg}</th>
                <td>${item.red}</td>
                <td>${descifrarAES(item.pass)}</td>
                <td>${item.fecha}</td>
                <td>
                    <button class="devBtn btn btn-sm btn-secondary text-white" onclick="verSubs(${item.id})">Renovar</button>
                    &nbsp
                    <button class="devBtn btn btn-sm btn-danger text-white" onclick="delAsigSub(${item.id})">Eliminar</button>
                </td>
            </tr>
        `);
    });

    $('#paginaActualModal').text(paginaSub);
    $('#btnAntModal').prop('disabled', paginaSub === 1);
    $('#btnSigModal').prop('disabled', fin >= filtradosSub.length);
};

$('#btnAntModal').click(() => {
    if (paginaSub > 1) {
        paginaSub--;
        mostrarSubs();
    }
});

$('#btnSigModal').click(() => {
    if ((paginaSub * regPagSub) < filtradosSub.length) {
        paginaSub++;
        mostrarSubs();
    }
});

$('#filtroNombre').on('input', () => {
    const filtro = $('#filtroNombre').val().toLowerCase();
    filtradosSub = datosSub.filter(item => item.red.toLowerCase().includes(filtro));
    paginaSub = 1;
    mostrarSubs();
});

async function getUser() {
    try {
        const response = await fetch(window.AppData.getCliente, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`Error del servidor: ${response.status}`);
        }

        const jsonData = await response.json();
        datosClient = jsonData;
        filtradosClient = [...datosClient];
        paginaClient = 1;

        mostrarCliente();

    } catch (error) {
        console.error('Ocurrió un error #1:', error);
    }
}

const mostrarCliente = () => {
    const inicio = (paginaClient - 1) * regPagClient;
    const fin = inicio + regPagClient;
    const datosPagina = filtradosClient.slice(inicio, fin);

    $('#tablaDatos').empty();

    datosPagina.forEach(item => {
        $('#tablaDatos').append(`
            <tr>
                <th scope="row">${item.id}</th>
                <td>${item.nombre}</td>
                <td>${item.codigo}</td>
                <td>${item.suscripcion}</td>
                <td>
                    <button class="devBtn btn btn-sm btn-secondary text-white" onclick="getSubs(${item.codigo})">Ver</button>
                    &nbsp
                    <button class="devBtn btn btn-sm btn-danger text-white" 
                    data-bs-toggle="modal" data-bs-target="#modalDelUsu" onclick="delAsigUser(${item.id})">Eliminar</button>
                    &nbsp
                    <button class="btn btn-sm btn-warning text-white" onclick="getList(${item.codigo},${item.id})">Suscripcion</button>
                </td>
            </tr>
        `);
    });

    $('#paginaActualTable').text(paginaClient);
    $('#btnAnteTable').prop('disabled', paginaClient === 1);
    $('#btnSigTable').prop('disabled', fin >= filtradosClient.length);
};

$('#btnAnteTable').click(() => {
    if (paginaClient > 1) {
        paginaClient--;
        mostrarCliente();
    }
});

$('#btnSigTable').click(() => {
    if ((paginaClient * regPagClient) < filtradosClient.length) {
        paginaClient++;
        mostrarCliente();
    }
});

$('#filtroCodig').on('input', () => {
    const filtro = $('#filtroCodig').val().toLowerCase();
    filtradosClient = datosClient.filter(item => item.codigo.toLowerCase().includes(filtro));
    paginaClient = 1;
    mostrarCliente();
});

async function getList(code,id) {
    document.getElementById('idCod').value= code;
    document.getElementById('idUser').value= id;

    try {
        const response = await fetch(window.AppData.getOnlyRedes, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ code: parseInt(id) })

        });

        if (!response.ok) {
            throw new Error(`Error del servidor: ${response.status}`);
        }

        const jsonData = await response.json();
        datosRed = jsonData;
        filtradosRed = [...datosRed];
        paginaRed = 1;

        mostrarList();
        $('#modalNew').modal('show');


    } catch (error) {
        console.error('Ocurrió un error #1:', error);
    }
}

const mostrarList = () => {
    const inicio = (paginaRed - 1) * regPagRed;
    const fin = inicio + regPagRed;
    const datosPagina = filtradosRed.slice(inicio, fin);

    $('#tablaDatos3').empty();

    datosPagina.forEach(item => {
        $('#tablaDatos3').append(`
            <tr>
                <th scope="row">${item.id}</th>
                <td>${item.red}</td>
                <td>
                    <div class="form-check">
                        <input class="form-check-input checkRed" type="checkbox" value="${item.id}" id="checkRed_${item.id}">
                        <label class="form-check-label" for="checkRed_${item.id}">
                            Asignar
                        </label>
                    </div>
                </td>
            </tr>
        `);
    });

    $('#paginaActualModalNew').text(paginaRed);
    $('#btnAntModalNew').prop('disabled', paginaRed === 1);
    $('#btnSigModalNew').prop('disabled', fin >= filtradosRed.length);
};

$('#btnAntModalNew').click(() => {
    if (paginaRed > 1) {
        paginaRed--;
        mostrarList();
    }
});

$('#btnSigModalNew').click(() => {
    if ((paginaRed * regPagRed) < filtradosRed.length) {
        paginaRed++;
        mostrarList();
    }
});

$('#filtroNombre2').on('input', () => {
    const filtro = $('#filtroNombre2').val().toLowerCase();
    filtradosRed = datosRed.filter(item => item.red.toLowerCase().includes(filtro));
    paginaRed = 1;
    mostrarList();
});

function delAsigSub($id){
    idDelSub = parseInt($id);
    $('#modalList').modal('hide');
    $('#modalDelete').modal('show');

}

function cancelDelSub(){
    idDelSub =0;
    $('#modalDelete').modal('hide');
    $('#modalList').modal('show');

}

async function delSubs(){

    try {
        $('#modalDelete').modal('hide');

        const response = await fetch(window.AppData.deleteSub, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ code: parseInt(idDelSub) })

        });

        if (!response.ok) {
            throw new Error(`Error del servidor no.4: ${response.status}`);
        }

        const jsonData = await response.json();
        if (jsonData['status'] === 200) msgToast(3);
        if (jsonData['status'] === 401) msgToast(15);

        contReg = 0;
        getUser();

    } catch (error) {
        console.error('Ocurrió un error #4:', error);
    }
}

async function saveSus() {

    document.querySelectorAll('.checkRed:checked').forEach(el => {
        selected.push(el.value);
    });

    if (selected.length === 0) {
        viewToas("Por favor selecciona al menos una red.");
        return;
    }

    const data = {
        checkRed: selected,
        fechaLimt: document.getElementById('fechaLimt').value,
        idUser: document.getElementById('idUser').value
    };
   

    try {
        const response = await fetch(window.AppData.createSubs, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)

        });

        if (!response.ok) {
            throw new Error(`Error del servidor: ${response.status}`);
        }

        const jsonData = await response.json();
        
        if (parseInt(jsonData['total']) >= 1){
            msgToast(2);
        }else{
            viewToas("Error inesperado al intentar guardar.")
        }

        getUser();

    } catch (error) {
        console.error('Ocurrió un error al guardar las suscripciones:', error);
        viewToas("Error inesperado al intentar guardar.")
    }
}

