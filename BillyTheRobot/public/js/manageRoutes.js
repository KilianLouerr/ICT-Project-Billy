function editInput(key) {
    toggleVisibilities(key);
}

function saveEdit(key) {
    toggleVisibilities(key);
    let value = document.getElementById('input' + key).value;
    document.cookie = 'value=' + value;

    let command = document.getElementById('idEditCommandDropdown' + key).value;
    document.cookie = 'command=' + command;

    window.location.href = "/editInstruction/" + key;
}

function setSelectPoints(select) {
    window.location.href = "/setSelectPoints/" + select.name + "/" + select.value;
}

function toggleVisibilities(key) {
    let idInput = "input" + key;
    let input = document.getElementById(idInput);
    input.disabled = !input.disabled;

    let idInstructionEditButton = "editButton" + key;
    let instrucionEditButton = document.getElementById(idInstructionEditButton);
    instrucionEditButton.disabled = !instrucionEditButton.disabled;

    let idInstructionSaveButton = "saveButton" + key;
    let saveButton = document.getElementById(idInstructionSaveButton);
    saveButton.disabled = !saveButton.disabled;

    let idDropdown = "idEditCommandDropdown" + key;
    let editDropDown = document.getElementById(idDropdown);
    editDropDown.disabled = !editDropDown.disabled;

    let idImageInstruction = "img" + key;
    let image = document.getElementById(idImageInstruction);
    let hidden = image.getAttribute("hidden");

    if (hidden) {
        image.removeAttribute("hidden");
    } else {
        image.setAttribute("hidden", "hidden");
    }
}
