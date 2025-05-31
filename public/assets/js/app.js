console.log("corriendo script App");

$(document).ready(function () {
    const currentPath = window.location.pathname;
    $('.navbar a').each(function () {
        const $link = $(this);
        const href = $link.attr('href');
        if (!href) return;

        const linkPath = new URL(href, window.location.origin).pathname;

        if (currentPath.startsWith(linkPath)) {
            $link.addClass('active').removeClass('devLink');
        } else {
            $link.removeClass('active').addClass('devLink');
        }
    });
});

hashCode = s => s.split('').reduce((a, b) => { a = ((a << 5) - a) + b.charCodeAt(0); return a & a }, 0)

function getCode(input) {
    let has = hashCode(document.getElementById(input).value);
    return has.toString();
}

function viewToas(message) {
    document.getElementById('toastLabel').textContent = message;

    var toastEl = document.getElementById('infoToast');
    var toast = new bootstrap.Toast(toastEl);
    toast.show();
}

async function msgToast(id){
    try {
        const response = await fetch('http://devsllanten.com/api/messageSerch', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ codeMessage: parseInt(id) })
        });

        if (!response.ok) {
            throw new Error(`Error del servidor: ${response.status}`);
        }

        const data = await response.json();
        data['status'] === 200 ? viewToas(data['message']) : viewToas(data['message']);

    } catch (error) {
        console.error('Ocurrió un error #2:', error);
    }
}

function loadFecha(id) {
    const fechaActual = new Date();

    const anio = fechaActual.getFullYear();
    const mes = String(fechaActual.getMonth() + 1).padStart(2, '0');
    const dia = String(fechaActual.getDate()).padStart(2, '0');

    document.getElementById(id).value = anio + "-" + mes + "-" + dia;
}

async function salir() {
    try {
        const response = await fetch('http://devsllanten.com/admin/exitDasboard', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`Error del servidor: ${response.status}`);
        }

        const data = await response.json();
        parseInt(data['status']) === 200 ? window.location.href = "http://devsllanten.com" : null;

    } catch (error) {
        console.error('Ocurrió un error #1:', error);
    }
}