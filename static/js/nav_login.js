$(function () {

    const login_modal = $('#login_modal');
    const login_form = $('#login_form');

    const upload_link = $('#upload_link');
    const error_response = $('#error_response');

    const salt = 'B8lIoP90'

    login_modal.modal('hide');

    upload_link.on('click', function (event) {

        event.preventDefault();
        error_response.text('');

        login_modal.modal('show');
        login_modal.appendTo('body');
    });

    login_form.on('submit', function (event) {

        event.preventDefault();

	let send_data = login_form.jsonify_form();
	
	send_data['modal_password'] = $.md5(send_data['modal_password'] + salt, null, true);

        $.ajax({
            type: 'POST',
            url: '/upload/verify/',
            dataType: 'JSON',
            data: send_data,
            success: function (response) {

                error_response.hide();

                if (response.hasOwnProperty('success')) {

                    login_modal.modal('hide');
                    window.location.href = '/upload/';
                }
                else if (response.hasOwnProperty('error')) {

                    error_response.html('<strong>' + response['error'] + '</strong>');
                    error_response.show();
                }
            },
            error: function (response) {

                error_response.html('<strong>Error requesting login from server</strong>');
                error_response.show();
            }
        });
    });
});
