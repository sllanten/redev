console.log("corriendo script AccesNode");

let datosClient = [], filtradosClient = [], paginaClient = 1;
const regPagClient = 10;

let datosSub = [], filtradosSub = [], paginaSub = 1;
const regPagSub = 5;

let datosRed = [], filtradosRed = [], paginaRed = 1;
const regPagRed = 10;

let datosSoli = [], filtradoSoli= [], paginaSoli = 1;
const regPagSoli = 10;

let idDelSub = 0,idEditSub = 0 ,idDelUser = 0, idEditClien=0;

$('#btnAntModal').click(() => { if (paginaSub > 1) { paginaSub--; mostrarSubs(); } });
$('#btnSigModal').click(() => { if ((paginaSub * regPagSub) < filtradosSub.length) { paginaSub++; mostrarSubs(); } });
setupFilter('#filtroNombre', () => datosSub, val => filtradosSub = val, mostrarSubs);

$('#btnAnteTable').click(() => { if (paginaClient > 1) { paginaClient--; mostrarCliente(); } });
$('#btnSigTable').click(() => { if ((paginaClient * regPagClient) < filtradosClient.length) { paginaClient++; mostrarCliente(); } });
setupFilter('#filtroCodig', () => datosClient, val => filtradosClient = val, mostrarCliente);

$('#btnAntModalNew').click(() => { if (paginaRed > 1) { paginaRed--; mostrarList(); } });
$('#btnSigModalNew').click(() => { if ((paginaRed * regPagRed) < filtradosRed.length) { paginaRed++; mostrarList(); } });
setupFilter('#filtroNombre2', () => datosRed, val => filtradosRed = val, mostrarList);

$('#btnAntSoli').click(() => { if (paginaSoli > 1) { paginaSoli--; mostrarSoli(); } });
$('#btnSigSoli').click(() => { if ((paginaSoli * regPagSoli) < filtradoSoli.length) { paginaSoli++; mostrarSoli(); } });
setupFilter('#filtroClient', () => datosSoli, val => filtradoSoli = val, mostrarSoli);

$(document).ready(function () {
    getUser();
});

function loadApiRes(info) {
    getUser();
    msgToast(parseInt(info))
    setTimeout(() => {
        getSoli();
        $('#modalSoli').modal('show');
    }, 2000);
}

async function apiFetch(url, body = {}) {
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: Object.keys(body).length ? JSON.stringify(body) : null
        });
        if (!response.ok) throw new Error(`Error del servidor: ${response.status}`);
        return await response.json();
    } catch (err) {
        console.error("Error en apiFetch:", err);
        viewToas("Error al conectar con el servidor.");
        throw err;
    }
}

function renderTable({ data, page, perPage, tableId, rowRenderer, pageLabelId, prevBtnId, nextBtnId }) {
    const inicio = (page - 1) * perPage;
    const fin = inicio + perPage;
    const datosPagina = data.slice(inicio, fin);

    const tableBody = $(tableId);
    tableBody.empty();

    datosPagina.forEach((item, index) => {
        tableBody.append(rowRenderer(item, index + inicio + 1));
    });

    $(pageLabelId).text(page);
    $(prevBtnId).prop('disabled', page === 1);
    $(nextBtnId).prop('disabled', fin >= data.length);
}

function setupFilter(inputId, originalDataGetter, setFilteredData, renderFn) {
    $(inputId).on('input', () => {
        const filtro = $(inputId).val().toLowerCase();
        const originalData = originalDataGetter();
        setFilteredData(originalData.filter(item =>
            Object.values(item).some(v => String(v).toLowerCase().includes(filtro))
        ));
        renderFn();
    });
}

async function getSubs(id) {
    try {
        const jsonData = await apiFetch(window.AppData.getSubs, { code: id });
        if (jsonData['data'].length === 0) msgToast(8);

        datosSub = jsonData['data'];
        filtradosSub = [...datosSub];
        paginaSub = 1;
        mostrarSubs();

        $('#modalList').modal('show');
        
    } catch (error) {
        console.error('Ocurrió un error en getSubs:', error);
    }
}

function mostrarSubs() {
    renderTable({
        data: filtradosSub,
        page: paginaSub,
        perPage: regPagSub,
        tableId: '#tablaDatos2',
        pageLabelId: '#paginaActualModal',
        prevBtnId: '#btnAntModal',
        nextBtnId: '#btnSigModal',
        rowRenderer: (item, index) => `
            <tr>
                <th scope="row">${index}</th>
                <td>${item.red}</td>
                <td>${descifrarAES(item.pass)}</td>
                <td>${item.fecha}</td>
                <td>
                    <button class="btn btn-sm btn-secondary text-white" onclick="verSubs(${item.id})">Renovar</button>
                    &nbsp
                    <button class="btn btn-sm btn-danger text-white" onclick="delAsigSub(${item.id})">Eliminar</button>
                </td>
            </tr>`
    });
}

async function getUser() {
    try {
        const jsonData = await apiFetch(window.AppData.getCliente);
        datosClient = jsonData;
        filtradosClient = [...datosClient];
        paginaClient = 1;
        mostrarCliente();
    } catch (error) {
        console.error('Ocurrió un error en getUser:', error);
    }
}

function mostrarCliente() {
    renderTable({
        data: filtradosClient,
        page: paginaClient,
        perPage: regPagClient,
        tableId: '#tablaDatos',
        pageLabelId: '#paginaActualTable',
        prevBtnId: '#btnAnteTable',
        nextBtnId: '#btnSigTable',
        rowRenderer: (item, index) => `
            <tr>
                <th scope="row">${index}</th>
                <td>${item.nombre}</td>
                <td>${descifraCode(item.codigo)}</td>
                <td>${item.suscripcion}</td>
                <td>
                    <button class="btn btn-sm btn-secondary text-white" onclick="getSubs('${item.codigo}')">ListDark</button>
                    &nbsp
                    <button class="btn btn-sm btn-warning text-black" onclick="getList(${item.id})">Suscripción</button>
                    &nbsp
                    <button class="btn btn-sm btn-primary text-white" onclick="
                        loadCli(${item.id},'${item.nombre}','${descifraCode(item.codigo)}')">
                        Actualizar
                    </button>
                    &nbsp
                    <button class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelUsu" onclick="PredelAsigSub(${item.id})">Eliminar</button>                    
                </td>
            </tr>`
    });
}

async function getList(id) {
    idEditSub= parseInt(id);

    try {
        const jsonData = await apiFetch(window.AppData.getOnlyRedes, { code: parseInt(id) });
        datosRed = jsonData;
        filtradosRed = [...datosRed];
        paginaRed = 1;
        mostrarList();
        $('#modalNew').modal('show');
    } catch (error) {
        console.error('Ocurrió un error en getList:', error);
    }
}

function mostrarList() {
    renderTable({
        data: filtradosRed,
        page: paginaRed,
        perPage: regPagRed,
        tableId: '#tablaDatos3',
        pageLabelId: '#paginaActualModalNew',
        prevBtnId: '#btnAntModalNew',
        nextBtnId: '#btnSigModalNew',
        rowRenderer: (item, index) => `
            <tr>
                <th scope="row">${index}</th>
                <td>${item.red}</td>
                <td>
                    <div class="form-check">
                        <input class="form-check-input checkRed" type="checkbox" value="${item.id}" id="checkRed_${item.id}">
                        <label class="form-check-label" for="checkRed_${item.id}">Asignar</label>
                    </div>
                </td>
            </tr>`
    });
}

function delAsigSub(id) {
    idDelSub = parseInt(id);
    $('#modalList').modal('hide');
    $('#modalDelete').modal('show');
}

function PredelAsigSub(id){
    idDelSub= parseInt(id);
    $('#modalDelete').modal('hide');
}

function cancelDelSub() {
    idDelSub = 0;
    $('#modalDelete').modal('hide');
}

async function delSubs() {
    try {
        $('#modalDelete').modal('hide');
        const jsonData = await apiFetch(window.AppData.deleteSub, { code: parseInt(idDelSub) });

        if (jsonData['status'] === 200) msgToast(3);
        else if (jsonData['status'] === 401) msgToast(15);

        getUser();
    } catch (error) {
        console.error('Ocurrió un error en delSubs:', error);
    }
}

async function saveSus() {
    const selected = [];
    document.querySelectorAll('.checkRed:checked').forEach(el => selected.push(el.value));

    if (selected.length === 0) {
        viewToas("Por favor selecciona al menos una red.");
        return;
    }

    const data = {
        checkRed: selected,
        fechaLimt: document.getElementById('fechaLimt').value,
        idUser: parseInt(idEditSub)
    };

    try {
        const jsonData = await apiFetch(window.AppData.createSubs, data);

        if (parseInt(jsonData['total']) >= 1) {
            msgToast(2);
        } else {
            viewToas("Error inesperado al intentar guardar.");
        }

        getUser();
        idEditSub = 0;

    } catch (error) {
        console.error('Ocurrió un error al guardar las suscripciones:', error);
        viewToas("Error inesperado al intentar guardar.");
    }
}

function resetLIst(){
}

async function getSoli() {
    try {
        const jsonData = await apiFetch(window.AppData.getSoli);

        datosSoli = jsonData['data'];
        filtradoSoli = [...datosSoli];
        paginaSoli = 1;
        mostrarSoli();

        $('#modalSoli').modal('show');
    } catch (error) {
        console.error('Ocurrió un error en getSoli:', error);
    }
}

function mostrarSoli() {
    renderTable({
        data: filtradoSoli,
        page: paginaSoli,
        perPage: regPagSoli,
        tableId: '#tablaDatos4',
        pageLabelId: '#pagActualSoli',
        prevBtnId: '#btnAntSoli',
        nextBtnId: '#btnSigSoli',
        rowRenderer: (item, index) => `
            <tr>
                <th scope="row">${index}</th>
                <td>${item.cliente}</td>
                <td>${descifraCode(item.celular)}</td>
                <td>
                    <button class="btn btn-sm btn-secondary text-white" onclick="gstSoli(${item.id},2,'${item.cliente}','${item.celular}')">Aceptar</button>
                    &nbsp
                    <button class="btn btn-sm btn-danger text-white" onclick="gstSoli(${item.id},3)">Cancelar</button>
                </td>
            </tr>`
    });
}

async function gstSoli(id, status, client, code) {
    const data = {
        idSoli: parseInt(id),
        estado: parseInt(status)
    };
    const data2 = {
        client: client,
        codigo: code
    };

    try {
        $('#modalSoli').modal('hide');

        if(parseInt(status)== 2) {

            const jsonData2 = await apiFetch(window.AppData.createClient, data2);

            if (jsonData2['status'] == 200) {
                const jsonData = await apiFetch(window.AppData.updateSoli, data);
                loadApiRes(28);
            }

            if (jsonData2['status'] == 401) loadApiRes(30);
        }

        if(parseInt(status)== 3) {
            const jsonData = await apiFetch(window.AppData.updateSoli, data);

            if (jsonData['status'] == 200) loadApiRes(29);
            if (jsonData['status'] == 401) loadApiRes(30);
        }

    } catch (error) {
        console.error('Ocurrió un error en updateSoli:', error);
    }
}

async function getClient() {

    $('#modalNewCliente').modal('hide');

    let nameInput = document.getElementById('nameClient');
    let codeInput = document.getElementById('codClient');

    let reqClient = nameInput.value.trim();
    let reqCode = codeInput.value.trim();

    let valido = true;

    nameInput.classList.remove("is-invalid");
    codeInput.classList.remove("is-invalid");

    if (reqClient === "" || reqClient.length < 3) {
        nameInput.classList.add("is-invalid");
        valido = false;
    }

    if (!/^\d{4,10}$/.test(reqCode)) {
        codeInput.classList.add("is-invalid");
        valido = false;
    }

    if (!valido) {
        return;
    }

    const data = {
        client: reqClient,
        codigo: cifrarCode(reqCode)
    };

    try {
        const jsonData = await apiFetch(window.AppData.createClient, data);

        if(jsonData['status']== 200) {
            $("#nameClient").val("").removeClass("is-invalid");
            $("#codClient").val("").removeClass("is-invalid");

            setTimeout(() => {
                getUser();
                msgToast(35);
            }, 2000);

        }
    } catch (error) {
        console.error('Ocurrió un error en getClient:', error);
    }
}

function loadCli(idCli,client,code) {
    idEditClien= parseInt(idCli);
    
    $('#nameClientEdit').val(client);
    $('#codClientEdit').val(code);

    $('#modalEditCl').modal('show');
}

async function editClient(){
    $('#modalEditCl').modal('hide');

    const data = {
        idEdit: parseInt(idEditClien),
        clientEdit: document.getElementById('nameClientEdit').value,
        codigoEdit: cifrarCode(document.getElementById('codClientEdit').value)
    };
    
    try {

        const jsonData = await apiFetch(window.AppData.updateClient, data);
        if (jsonData['status'] == 200) msgToast(37);
        if (jsonData['status'] == 401) msgToast(39);
        if (jsonData['status'] == 409) msgToast(38);

        getUser();
        
    } catch (error) {
        console.error('Ocurrió un error en updateSoli:', error);
    }

}

function cancelEditSub(){
    idEditClien = 0;
}