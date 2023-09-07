// loadHeader
async function loadHeader() {
    const response = await fetch('/src/users/technician/headerFooter/TaTssHeader/TaTssHeader.html');
    const html = await response.text();
    document.getElementById('headerContainer').innerHTML = html;
}
loadHeader();
