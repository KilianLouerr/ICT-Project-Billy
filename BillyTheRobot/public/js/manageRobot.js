const modal = document.querySelector("#modal");

function openModal(name, id, tId) {

    const robotNameInput = document.querySelector("#robotNameInput");
    const robotId = document.querySelector("#robotId");
    const tourId = document.querySelector("#tourId");

    const tourSelect = document.querySelector("#tourSelected");

    robotNameInput.value = name;
    robotId.value = id;
    tourId.value = tId;

    for (let i = 0; i < tourSelect.options.length; i++) {
        const option = tourSelect.options[i];

        if (option.value == tId) {
            option.selected = true;
        } else {
            option.selected = false;
        }
    }

    modal.showModal();
}

function closeModal() {
    modal.close();
}

function deleteConfirm(id) {
    var result = confirm("Ben je zeker dat je deze robot wilt verwijderen?");
    if (result) {
        document.getElementById("removeRobot" + id).submit();
    }
}

const statusInputs = document.querySelectorAll('input[type=radio][name=status]');
var currentLocation = window.location.pathname.replace('/manageRobots/', '');

document.getElementById(currentLocation).checked = true;

statusInputs.forEach(function (input) {
    input.addEventListener('change', function () {
        let value = this.value;

        window.location.href = "/manageRobots/" + value;
    });
});
