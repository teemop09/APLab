// loadFooter
async function loadFooter() {
    const response = await fetch('/TssHeaderAndFooter/TssFooter.html');
    const html = await response.text();
    document.getElementById('footerContainer').innerHTML = html;
}
loadFooter();
