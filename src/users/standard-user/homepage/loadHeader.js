
async function loadHeader() {
    const response = await fetch('/src/users/standard-user/header-footer/header.html');
    const html = await response.text();
    document.getElementById('headerContainer').innerHTML = html;
}
loadHeader();
