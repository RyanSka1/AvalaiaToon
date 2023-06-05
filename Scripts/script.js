function validateForm() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var email = document.getElementById('email').value;
    var cpf = document.getElementById('cpf').value;
    var phone = document.getElementById('phone').value;

    var emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    var cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
    var phoneRegex = /^\(\d{2}\)\s\d{4,5}-\d{4}$/;

    if(username == "" || password == "" || email == "" || cpf == "" || phone == ""){
        alert("Por favor, preencha todos os campos.");
        return false;
    }

    if(!emailRegex.test(email)){
        alert("Email inválido.");
        return false;
    }

    if(!cpfRegex.test(cpf)){
        alert("CPF inválido. Use o formato xxx.xxx.xxx-xx");
        return false;
    }

    if(!phoneRegex.test(phone)){
        alert("Telefone inválido. Use o formato (xx) xxxx-xxxx ou (xx) xxxxx-xxxx");
        return false;
    }
    
    return true;
}
