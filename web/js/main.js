$(function () {
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
    $('.update-modal-click').click(function () {
        $('#update-modal')
                .modal('show')
                .find('#updateModalContent')
                .load($(this).attr('value'));
    });
});