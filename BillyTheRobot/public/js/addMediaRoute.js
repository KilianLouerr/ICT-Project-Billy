// get references to the form elements
var mediaForm = document.getElementById('media-form');
var routeForm = document.getElementById('route-form');
var typeSelect = document.getElementById('type-select');

// show media form by default
mediaForm.style.display = 'none';
routeForm.style.display = 'none';

// add event listener for changes in the dropdown menu
typeSelect.addEventListener('change', function () {
    if (typeSelect.value === 'media') {
        // show media form, hide route form
        mediaForm.style.display = 'block';
        routeForm.style.display = 'none';
    } else if (typeSelect.value === 'route') {
        // show route form, hide media form
        mediaForm.style.display = 'none';
        routeForm.style.display = 'block';
    }
});

const mediaLinkInput = document.getElementById('mediaLinkInput');
const htmlCodeInput = document.getElementById('html-code');
const addMediaButton = document.getElementById('media-toevoegen');
const mediaName = document.getElementById('mediaName');

mediaLinkInput.addEventListener('input', function () {
    if (mediaLinkInput.value) {
        htmlCodeInput.disabled = true;
    } else {
        htmlCodeInput.disabled = false;
    }
});

htmlCodeInput.addEventListener('input', function () {
    if (htmlCodeInput.value) {
        mediaLinkInput.disabled = true;
    } else {
        mediaLinkInput.disabled = false;
    }
});

function enableDisableButton() {
    const isMediaNameFilled = mediaName.value.trim() !== '';
    const isHtmlCodeFilled = htmlCodeInput.value.trim() !== '';
    const isLinkFilled = mediaLinkInput.value.trim() !== '';
    const isButtonDisabled = !(isMediaNameFilled && (isHtmlCodeFilled || isLinkFilled));
    addMediaButton.disabled = isButtonDisabled;
}

mediaLinkInput.addEventListener('input', enableDisableButton);
htmlCodeInput.addEventListener('input', enableDisableButton);
mediaName.addEventListener('input', enableDisableButton);

const routeSelect = document.getElementById('routeSelect');
const addRouteButton = document.getElementById('routeToevoegen');

routeSelect.addEventListener('input', function () {
    if (routeSelect.selected = null) {
        addRouteButton.disabled = true;
    }
    else {
        addRouteButton.disabled = false;
    }
});
