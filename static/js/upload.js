$(function () {

    const form = $('#sounding_data');

    const error_response = $('#error_response');
    const info_response = $('#info_response');
    const success_response = $('#success_response');

    form.on('submit', function (event) {

        error_response.text('');
        info_response.text('Submitting file(s)...');
        success_response.text('');

        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'files/',
            contentType: false,
            processData: false,
            data: form.jsonify_file_form(),
            success: function (response) {

                if (response.hasOwnProperty('success')) {
                    success_response.text(response['success']);
                }

                if (response.hasOwnProperty('info')) {
                    success_response.text(response['info']);
                }
            },
            error: function (response) {
                error_response.text('Error submitting file(s)');
            }
        });
    });
});