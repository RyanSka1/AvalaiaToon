document.getElementById('username').textContent = sessionStorage.getItem('username');

function logout() {
    // Fazendo uma solicitação GET para o script de logout do lado do servidor
    fetch('logout.php')
        .then(response => response.text())
        .then(data => console.log(data))
        .catch((error) => {
            console.error('Error:', error);
        });

    sessionStorage.removeItem('username');
    window.location = 'login.html';
}
