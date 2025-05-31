console.log("corriendo script Red");
console.log("Api ListDark get", window.AppData.getLisDark);
console.log("Api ListDark create", window.AppData.createLisDark);
console.log("Api ListDark delete", window.AppData.deleteLisDark);
console.log("Api ListDark update", window.AppData.updateLisDark);

let datosRed = [];
let filtradosRed = [];
let paginaRed = 1;
const regPagRed = 10;

let idDetele= null;
let idUpdate= null;

$(document).ready(function () {
    getList();
});

async function getList() {
    try {
        const response = await fetch(window.AppData.getLisDark, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`Error del servidor de Api #1: ${response.status}`);
        }

        const jsonData = await response.json();

        datosRed = jsonData;
        filtradosRed = [...datosRed];
        paginaRed = 1;

        mostrarList();

        $('#modalList').modal('show');


    } catch (error) {
        console.error('Ocurrió un error Api #1:', error);
    }
}

const mostrarList = () => {
    const inicio = (paginaRed - 1) * regPagRed;
    const fin = inicio + regPagRed;
    const datosPagina = filtradosRed.slice(inicio, fin);
    let index=1

    $('#tablaDatos').empty();

    datosPagina.forEach(item => {
        $('#tablaDatos').append(`
            <tr>
                <th scope="row">${index++}</th>
                <td>${item.red}</td>
                <td>${item.pass}</td>
                <td>${item.fechareg}</td>
                <td>${item.fechamod}</td>
                <td>
                    <input type="button" class="devBtn btn btn-sm btn-warning text-white" 
                    onclick="loadModal('${item.id}','${item.red}','${item.pass}','${item.fechareg}');" value="Editar">
                    &nbsp
                    <button class="devBtn btn btn-sm btn-danger text-white" 
                    onclick="loadDelete('${item.id}')">Eliminar</button>
                </td>
            </tr>
        `);
    });

    $('#paginaActual').text(paginaRed);
    $('#btnTableAnt').prop('disabled', paginaRed === 1);
    $('#btnTableSig').prop('disabled', fin >= filtradosRed.length);
};

$('#btnTableAnt').click(() => {
    if (paginaRed > 1) {
        paginaRed--;
        mostrarList();
    }
});

$('#btnTableSig').click(() => {
    if ((paginaRed * regPagRed) < filtradosRed.length) {
        paginaRed++;
        mostrarList();
    }
});

$('#filtroNombre').on('input', () => {
    const filtro = $('#filtroNombre').val().toLowerCase();
    filtradosRed = datosRed.filter(item => item.red.toLowerCase().includes(filtro));
    paginaRed = 1;
    mostrarList();
});

function loadModal(id,red,pass,fechareg){

    idUpdate= parseInt(id);
    document.getElementById("EditName").value = red;
    document.getElementById("EditPass").value = pass;
    document.getElementById("EditFecha").value = fechareg;

    $('#modalEditRed').modal('show');
}

function cancelarUpdate() {
    idUpdate= null;
}

function loadDelete(idRed){
    idDetele= parseInt(idRed);
    $('#modalDelete').modal('show');
}

function cancelarDelete() {
 idDetele=null;   
}

async function deleteRed(){
    if (idDetele === null) {
        
        return;
    }
    $('#modalDelete').modal('hide');

    try {
        const response = await fetch(window.AppData.deleteLisDark, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ code: parseInt(idDetele) })
        });

        if (!response.ok) {
            throw new Error(`Error del servidor Api #2: ${response.status}`);
        }

        const jsonData = await response.json();
        jsonData['status'] === 200 ? msgToast(9) : msgToast(10);

        idDetele=null;
        
        getList();

    } catch (error) {
        console.error('Ocurrió un error  Api #2:', error);
    }
}

function validateCreate(){
    const red = document.getElementById('newName').value.trim();
    const pass = document.getElementById('newPass').value.trim();
    if (red === '' || pass === '') {
      msgToast(11);
    }else{
        $('#modalRed').modal('hide');

        createList();
    }
    
}

async function createList(){
    try {
        const response = await fetch(window.AppData.createLisDark, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                newName: document.getElementById('newName').value,
                newPass: document.getElementById('newPass') .value
            })

        });

        if (!response.ok) {
            throw new Error(`Error del servidor Api #3: ${response.status}`);
        }

        const jsonData = await response.json();
        jsonData['status'] === 200 ? msgToast(12) : msgToast(13);

        getList();

    } catch (error) {
        console.error('Ocurrió un error Api #3:', error);
    }
}

function validateUpdate() {
    const red = document.getElementById('EditName').value.trim();
    const pass = document.getElementById('EditPass').value.trim();
    if (red === '' || pass === '') {
        msgToast(11);
    } else {
        $('#modalEditRed').modal('hide');

        updateList();
    }
}

async function updateList() {
    try {
        const response = await fetch(window.AppData.updateLisDark, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                idRed: parseInt(idUpdate),
                EditName: document.getElementById('EditName').value,
                EditPass: document.getElementById('EditPass').value
            })

        });

        if (!response.ok) {
            throw new Error(`Error del servidor Api #4: ${response.status}`);
        }

        const jsonData = await response.json();
        jsonData['status'] === 200 ? msgToast(12) : msgToast(14);

        idUpdate= null;

        getList();

    } catch (error) {
        console.error('Ocurrió un error Api #4:', error);
    }
}