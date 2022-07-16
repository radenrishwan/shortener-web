const destination = document.getElementById('destination')
const alias = document.getElementById('alias')
const output = document.getElementById('output')

const aliasInputAlert = document.getElementById('alias-input-alert')
const destinationInputAlert = document.getElementById('destination-input-alert')
const errorAlert = document.getElementById('error-alert')


const createButton = document.getElementById('create-button')
const copyUrl = document.getElementById("copy-url")
const errorButton = document.getElementById('error-button')

const sideNav = document.getElementById("sidenav")

let isDestinationValid = false
let isAliasValid = false
let isSuccess = false

copyUrl.onclick = () => {
    console.log("test")
}

if (errorButton != null) {
    errorButton.onclick = () => {
        errorAlert.remove()
    }
}

destination.onkeyup = () => {
    checkIfUrl(destination.value)
    checkForm()
}

destination.onkeydown = () => {
    checkIfUrl(destination.value)
    checkForm()
}

alias.onkeyup = () => {
    checkAliasLength(alias.value.length)
    checkForm()
}

alias.onkeydown = () => {
    checkAliasLength(alias.value.length)
    checkForm()
}

function checkIfUrl(url) {
    const expression = /(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/gi;
    const regex = new RegExp(expression);

    if (url.match(regex)) {
        const alertText = document.getElementById('destination-alert')

        if (alertText != null) {
            alertText.remove()
        }

        isDestinationValid = true
    } else {
        if (destinationInputAlert.children.length < 1) {
            const alertText = document.createElement('p')
            alertText.textContent = '⚠️ Destination must be valid url'
            alertText.id = 'destination-alert'
            alertText.classList = "text-red-600"

            destinationInputAlert.append(alertText)

            disableButton()
            isDestinationValid = false
        }
    }
}

function checkAliasLength(length) {
    if (length < 1) {
        disableButton()
        isAliasValid = false
    } else {
        isAliasValid = true
    }
}

function disableButton() {
    if (!createButton.classList.contains("pointer-events-none")) {
        createButton.classList.add('pointer-events-none')
    }
}

function checkForm() {
    console.log(isDestinationValid + " => " + isAliasValid);
    if (isDestinationValid && isAliasValid) {
        if (createButton.classList.contains("pointer-events-none")) {
            createButton.classList.remove('pointer-events-none')
        }
        console.log('enabled');
    }
}

function copyToClipboard() {
    console.log("running")

    copyUrl.select()
    copyUrl.setSelectionRange(0, 99999)

    navigator.clipboard.writeText(copyUrl.value)
}

function openNav() {
    sideNav.style.width = "500px"
}

function closeNav() {
    sideNav.style.width = "0px"
}