$(function () {

    const error_response = $('#error_response');
    const info_response = $('#info_response');
    const warning_response = $('#warning_response');
    const success_response = $('#success_response');

    const form = $('#sounding_data');

    form.on('submit', function (event) {

	event.preventDefault();

        error_response.hide();
        warning_response.hide();
        success_response.hide();

        info_response.html('<strong>Submitting file(s)...</strong>');
	info_response.show();

        $.ajax({
            type: 'POST',
            url: 'files/',
            contentType: false,
            processData: false,
            data: form.jsonify_file_form(),
            success: function (response) {

                if (response.hasOwnProperty('success')) {

                    success_response.html('<strong>' + response['success'] + '</strong>');
                    success_response.show();
                }

                if (response.hasOwnProperty('warning')) {

                    warning_response.html('<strong>' + response['warning'] + '</strong>');
                    warning_response.show();
                }

		info_response.hide();
            },
            error: function (response) {

                error_response.html('<strong>Error submitting file(s)</strong>');
                error_response.show();

                info_response.hide();
            }
        });
    });
});