function validateForm() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    
    if(username == "" || password == ""){
        alert("Por favor, preencha todos os campos.");
        return false;
    }
    return true;
}

function validateEmail() {
    var email = document.getElementById('email').value;
    
    if(email == ""){
        alert("Por favor, preencha o campo de email.");
        return false;
    }
    return true;
}
