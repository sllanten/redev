console.log("corriendo script App");
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