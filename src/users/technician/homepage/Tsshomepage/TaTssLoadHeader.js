// loadHeader
async function loadHeader() {
    const response = await fetch('/TssHeaderAndFooter/TaTssHeader.html');
    const html = await response.text();
    document.getElementById('headerContainer').innerHTML = html;
}
loadHeader();
