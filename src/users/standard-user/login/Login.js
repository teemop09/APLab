function showHidePw() {
    var inputType = document.getElementById('pw-input')
    var showHide = document.getElementById('pw-icon')

    if (inputType.type === "password") {
        inputType.type = "text"
        showHide.src = 'Logos/pw_shown.png'
    }
    else {
        inputType.type = "password"
        showHide.src = "Logos/pw_hidden.png"
    }
}

function errorMsg(inputBoxName, errorMsgBox, errorMsg) {
    /*DSD change color of error input box*/
    var colorCode = "#FF6961"

    document.getElementById(errorMsgBox).innerHTML = errorMsg
    document.getElementById(inputBoxName).style.outline = colorCode + " 3px solid"
}

function clearStyle(inputBox, errorMsgBox) {
    document.getElementById(inputBox).style.removeProperty('outline')
    document.getElementById(errorMsgBox).innerHTML = ""
}

function checkQueryString() {
    var query_string = location.search

    if (query_string == "") {
        return;
    }
    errorMsg("login", "em-login", "Username does not exist or password is incorrect!")

}

