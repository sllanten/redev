console.log("Corriendo script Admin");
let idEditMessage = 0;

let state = {
    message: { data: [], filtered: [], page: 1, perPage: 10 },
    endpoint: { data: [], filtered: [], page: 1, perPage: 10 }
};

$(document).ready(() => {
    fetchData("message", window.AppData.getMessage);
    fetchData("endpoint", window.AppData.getEndpointApi);

    $('#filtroNombre').on('input', () => {
        filterData("message", "#filtroNombre", "mensaje");
    });

    $('#filtroNombre2').on('input', () => {
        filterData("endpoint", "#filtroNombre2", "nombre");
    });

    $('#btnTableAnt').click(() => changePage("message", -1));
    $('#btnTableSig').click(() => changePage("message", +1));

    $('#btnTableAnt2').click(() => changePage("endpoint", -1));
    $('#btnTableSig2').click(() => changePage("endpoint", +1));
});

async function fetchData(type, url) {
    try {
        const response = await fetch(url, { method: "POST", headers: { "Content-Type": "application/json" } });
        if (!response.ok) throw new Error(`Error del servidor (${type}): ${response.status}`);

        const jsonData = await response.json();
        state[type].data = jsonData;
        state[type].filtered = [...jsonData];
        state[type].page = 1;

        renderTable(type);
    } catch (error) {
        console.error(`Ocurrió un error con ${type}:`, error);
    }
}

function renderTable(type) {
    const { filtered, page, perPage } = state[type];
    const inicio = (page - 1) * perPage;
    const fin = inicio + perPage;
    const datosPagina = filtered.slice(inicio, fin);

    const tablaId = type === "message" ? "#tablaDatos" : "#tablaDatos2";
    const paginaId = type === "message" ? "#paginaActual" : "#paginaActual2";
    const btnAnt = type === "message" ? "#btnTableAnt" : "#btnTableAnt2";
    const btnSig = type === "message" ? "#btnTableSig" : "#btnTableSig2";

    $(tablaId).empty();

    datosPagina.forEach((item, index) => {
        if (type === "message") {
            $(tablaId).append(`
                <tr>
                    <th scope="row">${inicio + index + 1}</th>
                    <td>${item.mensaje}</td>
                    <td><span class="${item.class}">${item.tipo}</span></td>
                    <td>
                        <button class="btn btn-sm btn-warning text-white" onclick="verMsg(${item.id}, '${item.mensaje}', '${item.tipo}')">Editar</button>
                        <button class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="canEdit(${item.id})">Eliminar</button>
                    </td>
                </tr>
            `);
        } else {
            $(tablaId).append(`
                <tr>
                    <th scope="row">${inicio + index + 1}</th>
                    <td>${item.nombre}</td>
                    <td>${item.descripcion}</td>
                    <td>${item.url}</td>
                    <td>
                        <button class="btn btn-sm btn-warning text-white" onclick="verSubs(${item.id})">Editar</button>
                        <button class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="canEdit(${item.id})">Eliminar</button>
                    </td>
                </tr>
            `);
        }
    });

    $(paginaId).text(page);
    $(btnAnt).prop("disabled", page === 1);
    $(btnSig).prop("disabled", fin >= filtered.length);
}

function changePage(type, dir) {
    const { page, perPage, filtered } = state[type];
    const newPage = page + dir;
    if (newPage > 0 && (newPage - 1) * perPage < filtered.length) {
        state[type].page = newPage;
        renderTable(type);
    }
}

function filterData(type, inputId, field) {
    const filtro = $(inputId).val().toLowerCase();
    state[type].filtered = state[type].data.filter(item => item[field].toLowerCase().includes(filtro));
    state[type].page = 1;
    renderTable(type);
}

async function updateMsg(id, msg, tipo, clase) {
    try {
        const response = await fetch(window.AppData.updateMsg, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ id, msg, tipo, class: clase })
        });

        if (!response.ok) throw new Error(`Error del servidor (updateMsg): ${response.status}`);

        const jsonData = await response.json();

        if (jsonData.status === 200) {
            msgToast(16);
        } else {
            msgToast(18); 
        }

        idEditMessage = 0;
        fetchData("message", window.AppData.getMessage);
        fetchData("endpoint", window.AppData.getEndpointApi);

    } catch (error) {
        console.error("Ocurrió un error en updateMsg:", error);
    }
}

async function createMsg(msg, tipo, clase) {
    try {
        const response = await fetch(window.AppData.createMsg, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ msg, tipo, class: clase })
        });

        if (!response.ok) throw new Error(`Error del servidor (createMsg): ${response.status}`);

        const jsonData = await response.json();

        if (jsonData.status === 200) {
            
            msgToast(20); 
        } else {
            msgToast(21); 
        }

        fetchData("message", window.AppData.getMessage);
        fetchData("endpoint", window.AppData.getEndpointApi);

    } catch (error) {
        console.error("Ocurrió un error en createMsg:", error);
    }
}

function verMsg(id, msg, tipo) {
    idEditMessage = id;
    $("#editMessage").val(msg);
    $("#tipoEdit").val(tipo);

    const select = $("#EditselectType").empty();
    const opciones = [
        { value: "badge bg-secondary", text: "Sistema" },
        { value: "badge bg-primary", text: "Suscripcion" },
        { value: "badge bg-primary", text: "List Dark" }
    ];

    opciones.forEach(op => {
        select.append(new Option(op.text, op.value, false, op.text === tipo));
    });

    $("#modalEditMessage").modal("show");
}

function validMsgEdit() {
    $("#modalEditMessage").modal("hide");

    const msg = $("#editMessage").val().trim();
    const select = $("#EditselectType")[0];
    const clase = select.value;
    const tipo = select.options[select.selectedIndex].text;

    if (!idEditMessage || !msg || !clase || !tipo) {
        msgToast(11);
        return;
    }
    updateMsg(idEditMessage, msg, tipo, clase);
}

function validMsgCreate() {
    $("#modalNewMessage").modal("hide");

    const msg = $("#newMessage").val().trim();
    const select = $("#NewselectType")[0];
    const clase = select.value;
    const tipo = select.options[select.selectedIndex].text;

    if (!msg || select.selectedIndex === 0) {
        msgToast(11);
        return;
    }
    if (state.message.data.some(item => item.mensaje.toLowerCase() === msg.toLowerCase())) {
        msgToast(22);
    } else {
        createMsg(msg, tipo, clase);
    }
}
