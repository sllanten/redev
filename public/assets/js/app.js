console.log("corriendo script App");
const secretKey = CryptoJS.enc.Utf8.parse("12345678901234567890123456789012"); // 32 bytes (AES-256)
const iv = CryptoJS.enc.Utf8.parse("1234567890123456"); // 16 bytes (AES block size)

const secretKey2 = "clave_secreta_123"; // ¡CAMBIA esta clave por una más segura!
const tokenSup = "U2FsdGVkX1/NNdXvf9tyOIhZMJnn9lcrm/aqL19f/Ew="; // CONFIG APP

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

document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener('hidden.bs.modal', function () {
        if (document.activeElement) {
            document.activeElement.blur();
        }
    });
});

function getCode(input) {
    let has = cifrarCode(document.getElementById(input).value);
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

function cifrarAES(texto) {
    return CryptoJS.AES.encrypt(texto, secretKey2).toString();
}

function descifrarAES(textoCifrado) {
    try {
        const bytes = CryptoJS.AES.decrypt(textoCifrado, secretKey2);
        return bytes.toString(CryptoJS.enc.Utf8);
    } catch (e) {
        console.error("Error al descifrar:", e);
        return "";
    }
}

function cifrarCode(texto) {
    try {
        const textoStr = String(texto);

        let encrypted = CryptoJS.AES.encrypt(
            CryptoJS.enc.Utf8.parse(textoStr),
            secretKey,
            {
                iv: iv,
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7
            }
        );
        return encrypted.toString(); // Base64

    } catch (e) {
        console.error("Error al cifrar:", e);
    }

}

function descifraCode(textoCifrado) {
    try {
        let decrypted = CryptoJS.AES.decrypt(
            textoCifrado,
            secretKey,
            {
                iv: iv,
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7
            }
        );
        return decrypted.toString(CryptoJS.enc.Utf8);
    } catch (e) {
        console.error("Error al descifrar:", e);
    }
}