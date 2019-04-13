$(function() {

    const current_station = $('[name=current_station]').val();
    const csrf_token = $('[name=csrfmiddlewaretoken]').val();

    $.ajax({
        type: 'POST',
        url: 'file_names/',
        dataType: 'json',
        data: {'current_station': current_station},
        headers: {
          'X-CSRFTOKEN': csrf_token
        },
        success: function(response) {

            let files = response['file_names'];

            for(let i = 0; i < files.length; i++) {
                $("#station").append('<option value="' + files[i] + (files[i] === current_station ? '" selected>' : '">') + files[i].replace(/_/g, " ") + "</option>");
            }

            let historyData = response['history_data'];

            $("#station_history").append(historyData);
        }
    });
});