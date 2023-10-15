function deleteConfirm(id) {
    var result = confirm("Ben je zeker dat je deze tour wilt verwijderen?");
    if (result) {
        document.getElementById("removeTour" + id).submit();
    }
}

async function openModal(id) {
    const clas = ".modal" + id;
    const modal = document.querySelector(clas);

    try {
        const url = `/getRoutesMedias/${id}`;
        const response = await axios.get(url);

        const routeMedia = response.data;

        const idList = "routeMediaList" + id;
        const list = document.getElementById(idList);
        list.innerHTML = '';

        for (const val of Object.values(routeMedia)) {
            if (val.type == "Route") {

                const li = document.createElement("li");

                const url2 = `/getPointsNames/${val.data.start_point}/${val.data.end_point}`;
                const response2 = await axios.get(url2);

                li.textContent = "Route: " + response2.data;
                list.appendChild(li);
            } else if (val.type == "Media") {

                const li = document.createElement("li");

                li.textContent = "Media: " + val.data.name;

                list.appendChild(li);
            }
        }

        modal.showModal();
    } catch (error) {
        console.log(error);
    }
}

function closeDialog(tourId) {
    const dialog = document.querySelector('.modal' + tourId);
    dialog.close();
}

function valueChanged() {
    alert("Sla eerst op voor je iets toevoegt");
}
