console.log("corriendo script Login");

async function sendCode() {
    const codeValue = getCode('code');
    if (codeValue == "") return;

    try {
        const response = await fetch('http://devsllanten.com/api/validateLogin', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ code: codeValue })
        });

        if (!response.ok) throw new Error(`Error del servidor (validateLogin): ${response.status}`);

        const jsonData = await response.json();

        parseInt(jsonData['status']) === 200
            ? window.location.href = "http://devsllanten.com/admin/dasboard"
            : parseInt(jsonData['status']) === 403
                ? respFail(jsonData['message'])
                : null;

    } catch (error) {
        console.error('Ocurrió un error #1:', error);
    }
}

function validate() {
    let has = getCode('code');

    if (has == "" || has == 0) return;
    if (has == "" || has == 0 || document.getElementById('term').checked == false) {
        msgToast(11);
        return;
    } else {
        sendCode();
    }
}

function respFail(message) {
    document.getElementById('code').value = null;
    document.getElementById('term').checked = false;
    viewToas(message);
}