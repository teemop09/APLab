// loadFooter
async function loadFooter() {
    const response = await fetch('TAHeaderAndFooter\TaFooter.html');
    const html = await response.text();
    document.getElementById('footerContainer').innerHTML = html;
}
loadFooter();
