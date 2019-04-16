$(function () {

    const login_modal = $('#login_modal');
    const login_form = $('#login_form');

    const error_text = $('#error_text');

    login_modal.modal('hide');

    $('#upload_link').click(function (event) {

        event.preventDefault();
        error_text.text('');

        login_modal.modal('show');
    });

    $('#login').click(function () {

        /*let form_data = {};

        $.map(login_form.serializeArray(), function (data, i) {
            form_data[data['name']] = data['value'];
        });*/

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
                    error_text.text(response['error']);
                }
            },
            error: function (response) {
                error_text.text('Error requesting login from server');
            }
        });
    });
});