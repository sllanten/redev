console.log("corriendo script");
hashCode = s => s.split('').reduce((a, b) => { a = ((a << 5) - a) + b.charCodeAt(0); return a & a }, 0)

function getCode() {
    let has = hashCode(document.getElementById('code').value);
    return has.toString();
}

function validate(){
    let has= getCode();
    if (has == "" || has == 0) return;
    if(document.getElementById('term').checked == false) return;
    console.log("cumple criterios");
}

function messageToast(message){
    document.getElementById('toastLabel').textContent = message;

    var toastEl = document.getElementById('infoToast');
    var toast = new bootstrap.Toast(toastEl);
    toast.show();
}