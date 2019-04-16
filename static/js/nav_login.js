$(function () {

    const login_modal = $('#login_modal');
    const login_form = $('#login_form');

    const upload_link = $('#upload_link');
    const error_response = $('#error_response');

    login_modal.modal('hide');

    upload_link.on('click', function (event) {

        event.preventDefault();
        error_response.text('');

        login_modal.modal('show');
        login_modal.appendTo('body');
    });

    //$('#login').click(function () {
    login_form.on('submit', function (event) {

        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/upload/verify/',
            dataType: 'JSON',
            data: login_form.jsonify_form(),//form_data,
            success: function (response) {

                if (response.hasOwnProperty('success')) {

                    login_modal.modal('hide');
                    window.location.replace('/upload/');
                }
                else if (response.hasOwnProperty('error')) {
                    error_response.text(response['error']);
                }
            },
            error: function (response) {
                error_response.text('Error requesting login from server');
            }
        });
    });
});