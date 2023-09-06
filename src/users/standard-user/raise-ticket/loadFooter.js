// loadFooter
async function loadFooter() {
    const response = await fetch('footer.html');
    const html = await response.text();
    document.getElementById('footerContainer').innerHTML = html;
}
loadFooter();
