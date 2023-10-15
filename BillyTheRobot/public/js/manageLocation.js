document.getElementById('removeLocationForm').addEventListener('submit', function (event) {
    var checkboxes = document.getElementsByName('point_id[]');
    var selectedValues = Array.from(checkboxes)
        .filter(function (checkbox) {
            return checkbox.checked;
        })
        .map(function (checkbox) {
            return checkbox.value;
        });

    if (selectedValues.length === 0) {
        event.preventDefault(); // Prevent form submission if no checkboxes are selected
        alert('Selecteer minstens één checkbox.');
    }
});
