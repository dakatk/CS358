$(function() {

    // TODO these should be derived from form data
    const current_station = $('[name=current_station]').val();
    const csrf_token = $('[name=csrfmiddlewaretoken]').val();

    const error_response = $('#error_response');

    $.ajax({
        type: 'POST',
        url: 'file_names/',
        dataType: 'json',
        data: {'current_station': current_station, 'csrfmiddlewaretoken': csrf_token},
        /*headers: {
          'X-CSRFTOKEN': csrf_token
        },*/
        success: function(response) {

            let files = response['file_names'];

            // TODO reformat
            for(let i = 0; i < files.length; i++) {
                $("#station").append('<option value="' + files[i] + (files[i] === current_station ? '" selected>' : '">') + files[i].replace(/_/g, " ") + "</option>");
            }

            let historyData = response['history_data'];

            $("#station_history").append(historyData);
        },
        error: function (response) {
            error_response.text('Error loading data');
        }
    });
});