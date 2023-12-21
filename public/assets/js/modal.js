$(document).ready(function() {
    $('.show-text').click(function() {
        var fullText = $(this).data('full-text');
        var modalBody = $('#textModal .modal-body');
        modalBody.text(fullText);
        $('#textModal').modal('show');
    });
});