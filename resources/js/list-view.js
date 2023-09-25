$(function () {
    $("#select-all-items").on('change', function () {
        $('.table-item-checkbox').prop('checked', false);
        if (this.checked) {
            $('.table-item-checkbox').prop('checked', true);
        }
    });


    $(".table-item-checkbox").on('change', function () {
        $("#select-all-items").prop('checked', false);
    });
});
