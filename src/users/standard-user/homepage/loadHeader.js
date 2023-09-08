// loadHeader
async function loadHeader() {
    const response = await fetch('/src/users/standard-user/headerFooter/header.html');
    const html = await response.text();
    document.getElementById('headerContainer').innerHTML = html;
}
loadHeader();
