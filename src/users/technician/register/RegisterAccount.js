function errorMsg(inputBoxName, errorMsgBox, errorMsg) {
    /*DSD change color of error input box*/
    var colorCode = "#FF6961"

    document.getElementById(errorMsgBox).innerHTML = errorMsg
    document.getElementById(inputBoxName).style.outline = colorCode + " 3px solid"
    return false;
}

function validField(inputBoxName) {
    /*DSD change color of valid input field*/
    var colorCode = "#07097ea6"

    document.getElementById(inputBoxName).style.outline = colorCode + " 3px solid"

    return true
}

function validateForm1() {
    var id = document.getElementById("id").value
    var fname = document.getElementById("fname").value
    var lname = document.getElementById("lname").value
    var email = document.getElementById("email").value
    var passwd = document.getElementById("passwd").value
    var cpasswd = document.getElementById("cpasswd").value
    var contact = document.getElementById("contact").value
    var role = document.getElementById("role").value

    var valInput0 = idCheck(id)
    var valInput1 = fnameCheck(fname)
    var valInput2 = emailCheck(email)
    var valInput3 = lnameCheck(lname)
    var valInput4 = pwCheck(passwd)
    var valInput5 = pwMatchCheck(cpasswd)
    var valInput6 = contactCheck(contact)
    var valInput7 = roleCheck(role)

    var validInput = valInput0 && valInput1 && valInput2 && valInput3 && valInput4 && valInput5 && valInput6 && valInput7

    var notNull0 = inputNotNull("id", id)
    var notNull1 = inputNotNull("fname", fname)
    var notNull2 = inputNotNull("email", email)
    var notNull3 = inputNotNull("lname", lname)
    var notNull4 = inputNotNull("passwd", passwd)
    var notNull5 = inputNotNull("cpasswd", cpasswd)
    var notNull6 = inputNotNull("contact", contact)

    var notNull = notNull0 && notNull1 && notNull2 && notNull3 && notNull4 && notNull5 && notNull6
    var valid = validInput && notNull

    if (valid) {
        document.getElementById('sign-up-form').submit()
    }
}

function validateForm2() {
    var fname = document.getElementById("fname").value
    var lname = document.getElementById("lname").value
    var email = document.getElementById("email").value
    var passwd = document.getElementById("passwd").value
    var cpasswd = document.getElementById("cpasswd").value
    var contact = document.getElementById("contact").value
    var ts = document.getElementById("ts").value
    var role = document.getElementById("role").value
    var department = document.getElementById("department").value

    var valInput1 = fnameCheck(fname)
    var valInput2 = emailCheck(email)
    var valInput3 = lnameCheck(lname)
    var valInput4 = pwCheck(passwd)
    var valInput5 = pwMatchCheck(cpasswd)
    var valInput6 = contactCheck(contact)
    var valInput7 = tsCheck(ts)
    var valInput8 = roleCheck(role)
    var valInput9 = departmentCheck(department)

    var validInput = valInput1 && valInput2 && valInput3 && valInput4 && valInput5 && valInput6 && valInput7 && valInput8 && valInput9

    var notNull1 = inputNotNull("fname", fname)
    var notNull2 = inputNotNull("email", email)
    var notNull3 = inputNotNull("lname", lname)
    var notNull4 = inputNotNull("passwd", passwd)
    var notNull5 = inputNotNull("cpasswd", cpasswd)
    var notNull6 = inputNotNull("contact", contact)
    var notNull7 = inputNotNull("ts", ts)

    var notNull = notNull1 && notNull2 && notNull3 && notNull4 && notNull5 && notNull6 && notNull7
    var valid = validInput && notNull

    if (valid) {
        document.getElementById('sign-up-form').submit()
    }
}

function inputNotNull(inputBoxName, value) {
    var errorMsgBoxName = "em-" + inputBoxName

    if (value == "") {
        return errorMsg(inputBoxName, errorMsgBoxName, "This field cannot be empty!")
    }

    return true
}

function idCheck(value) {
    if (value.length == 0) {
        return false
    }
    if (/^TP\d{6}$/.test(value)) {
        return validField("id")
    } else {
        return errorMsg("id", "em-id", "Enter a valid TP Number (TPXXXXXX)")
    }
}

function tsCheck(value) {
    if (value.length == 0) {
        return false
    }
    if (/^TS\d{4}$/.test(value)) {
        return validField("ts")
    } else {
        return errorMsg("ts", "em-ts", "Enter a valid TS Number (TSXXXX)")
    }
}

function fnameCheck(value) {
    /*DSD set min man username length*/
    var min_username_length = 3
    var max_username_length = 20

    if (value.length == 0) {
        return false
    }
    if (value.length < min_username_length) {
        return errorMsg("fname", "em-fname", "This username is too short!")
    }
    if (value.length > max_username_length) {
        return errorMsg("fname", "em-fname", "This username is too long!")
    }

    return validField("fname")
}

function lnameCheck(value) {
    /*DSD set min man username length*/
    var min_username_length = 3
    var max_username_length = 20

    if (value.length == 0) {
        return false
    }
    if (value.length < min_username_length) {
        return errorMsg("lname", "em-lname", "This username is too short!")
    }
    if (value.length > max_username_length) {
        return errorMsg("lname", "em-lname", "This username is too long!")
    }

    return validField("lname")
}

function emailCheck(value) {
    if (value.length == 0) {
        return false;
    }
    if (/^\w+([\.-]?\w+)*@mail.apu.edu.my$/.test(value)) {
        return validField("email")
    }
    return errorMsg("email", "em-email", "Enter a valid email address!(xxxxxxxx.@mail.apu.edu.my)")
}

function pwCheck(value) {
    /*DSD set min man passwd length*/
    var min_username_length = 8
    var max_username_length = 20

    if (value.length == 0) {
        return false
    }
    if (value.length < min_username_length) {
        return errorMsg("passwd", "em-passwd", "This password is too short!")
    }
    if (value.length > max_username_length) {
        return errorMsg("passwd", "em-passwd", "This password is too long!")
    }

    return validField("passwd")
}

function pwMatchCheck(value) {
    var passwdValue = document.getElementById('passwd').value

    if (value == "") {
        return false
    }
    if (value != passwdValue) {
        return errorMsg("cpasswd", "em-cpasswd", "Both passwords must match!")
    }

    return validField("cpasswd")
}

function roleCheck() {
    var selectElement = document.getElementById("role");

    if (parseInt(selectElement.selectedIndex) > 0) {
        return validField("role")
    } else {
        return errorMsg("role", "em-role", "Select a role!")
    }

}

function departmentCheck() {
    var selectElement = document.getElementById("department");

    if (parseInt(selectElement.selectedIndex) > 0) {
        return validField("department")
    } else {
        return errorMsg("department", "em-department", "Select a department!")
    }

}

function contactCheck(value) {
    if (value.length == 0) {
        return false;
    }
    if (/^0\d{1,10}$/.test(value)) {
        return validField("contact")
    }
    return errorMsg("contact", "em-contact", "Enter a valid contact number! (0123456789)")
}

function clearStyle(inputBox, errorMsgBox) {
    document.getElementById(inputBox).style.removeProperty('outline')
    document.getElementById(errorMsgBox).innerHTML = ""
}

function checkQueryString() {
    var query_string = location.search
    if (query_string == "") {
        return
    }

    var userError = "This ID already exists!"
    var emailError = "This email has already been used in another account!"

    if (query_string == '?id_exists') {
        errorMsg("id", "em-id", userError)
    } else if (query_string == '?email_exists') {
        errorMsg("email", "em-email", emailError)
    } else if (query_string == '?ts_exists') {
        errorMsg("ts", "em-ts", userError)
    }
    else if (query_string == '?idemail_exists') {
        errorMsg("id", "em-id", userError)
        errorMsg("email", "em-email", emailError)
    } else {
        errorMsg("ts", "em-ts", userError)
        errorMsg("email", "em-email", emailError)
    }

}

function showHidePw() {
    var inputType = document.getElementById('passwd')
    var showHide = document.getElementById('pw-icon')

    if (inputType.type === "password") {
        inputType.type = "text"
        showHide.src = '/src/assets/Logos/pw_shown.png'
    }
    else {
        inputType.type = "password"
        showHide.src = "/src/assets/Logos/pw_hidden.png"
    }
}

function showHideCPw() {
    var inputType = document.getElementById('cpasswd')
    var showHide = document.getElementById('pw-icon-cpd')

    if (inputType.type === "password") {
        inputType.type = "text"
        showHide.src = '/src/assets/Logos/pw_shown.png'
    }
    else {
        inputType.type = "password"
        showHide.src = "/src/assets/Logos/pw_hidden.png"
    }
}


