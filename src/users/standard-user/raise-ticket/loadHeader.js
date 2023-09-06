// loadHeader
async function loadHeader() {
    const response = await fetch('/src/users/standard-user/raise-ticket/header.html');
    const html = await response.text();
    document.getElementById('headerContainer').innerHTML = html;
}
loadHeader();
