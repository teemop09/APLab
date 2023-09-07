// loadFooter
async function loadFooter() {
    const response = await fetch('/src/users/technician/headerFooter/TaFooter/TaFooter.html');
    const html = await response.text();
    document.getElementById('footerContainer').innerHTML = html;
}
loadFooter();
