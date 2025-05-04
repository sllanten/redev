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

        if (!response.ok) {
            throw new Error(`Error del servidor: ${response.status}`);
        }

        const jsonData = await response.json();

        parseInt(jsonData['status']) === 200
            ? window.location.href = "http://devsllanten.com/admin/dasboard"
            : parseInt(jsonData['status']) === 403
                ? viewToas(jsonData['message'])
                : null;

    } catch (error) {
        console.error('Ocurrió un error #1:', error);
    }
}

function validate(){
    let has= getCode('code');
    if (has == "" || has == 0) return;
    if(document.getElementById('term').checked == false) return;
    sendCode();
}