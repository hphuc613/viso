$(document).ready(function () {
    /** Modal Ajax */
    $('.modal-ajax').on('hidden.bs.modal', function () {
        $(document).find('.datetime-modal').html('');
        $(this).find('.modal-body').html('');
    });
    $(document).on('click', '[data-bs-toggle=modal]', function () {
        var modal = $(this).attr('data-bs-target');
        var url = $(this).attr('href');
        if ($(modal).hasClass('modal-ajax')) {
            $.ajax({
                async: true,
                url: url,
                type: 'GET',
            }).done(function (response) {
                if (!$(modal).hasClass('show')) {
                    var _modal = new bootstrap.Modal('#' + $(modal).attr('id'));
                    _modal.show();
                }
                $(modal).find('.modal-body').html(response);
                if ($(modal).find('form').attr('action') === "") {
                    $(modal).find('form').attr('action', url);
                }

                /** Lost jquery */
                $(modal).find(".select2").select2();
            });
        }
    });
});
