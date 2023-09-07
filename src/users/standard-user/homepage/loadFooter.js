// loadFooter
async function loadFooter() {
    const response = await fetch('/src/users/standard-user/header-footer/footer.html');
    const html = await response.text();
    document.getElementById('footerContainer').innerHTML = html;
}
loadFooter();
