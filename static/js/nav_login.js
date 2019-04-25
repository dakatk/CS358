$(function () {

    const login_modal = $('#login_modal');
    const login_form = $('#login_form');

    const upload_link = $('#upload_link');
    const error_response = $('#error_response');

    const salt = 'B8lIoP90'

    login_modal.modal('hide');

    function getCookie(cname) {

        let name = cname + '=';

        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');

        for(let i = 0; i < ca.length; i++) {

            let c = ca[i];

            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }

            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return '';
    }

    upload_link.on('click', function (event) {

        event.preventDefault();
        error_response.text('');

	if (getCookie('save_login') == 'true') {
            window.location.href = '/upload/';
	}

        else {

            login_modal.modal('show');
            login_modal.appendTo('body');
        }
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

		    if ($('#save_login').prop('checked')) {
                        document.cookie = 'save_login=true; path=/';
		    }

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
