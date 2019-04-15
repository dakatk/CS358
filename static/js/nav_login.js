// TODO login logic (use POST to check login)
$(function () {

    const login_modal = $('#login_modal');

    $('#upload_link').click(function (event) {

        event.preventDefault();
        // TODO clear error messages on modal
        login_modal.modal('show');
    });

    $('#login').click(function () {

        const csrf_token = $('[name=csrfmiddlewaretoken]').val();
        const form = $('#login_form');

        let form_data = {};

        $.map(form.serializeArray(), function (data, i) {
            form_data[data['name']] = data['value'];
        });

        $.ajax({
            type: 'POST',
            url: '/upload/verify/',
            dataType: 'JSON',
            data: form_data,
            headers: {
                'X-CSRFTOKEN': csrf_token
            },
            success: function (response) {

                if (response.hasOwnProperty('success')) {

                    login_modal.modal('hide');
                    window.location.replace('/upload/');
                }
                else if (response.hasOwnProperty('error')) {
                    // TODO error message on modal
                }
            },
            error: function (response) {
                // TODO error message on modal
            }
        });
    });
});