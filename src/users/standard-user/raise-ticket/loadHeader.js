// loadHeader
async function loadHeader() {
    const response = await fetch('header.html');
    const html = await response.text();
    document.getElementById('headerContainer').innerHTML = html;
}
loadHeader();
