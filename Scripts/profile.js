document.getElementById('username').textContent = localStorage.getItem('username');

function logout() {
    localStorage.removeItem('username');
    window.location = 'login.html';
}
