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
        success: function(response) {

            let files = response['file_names'];

            // TODO reformat code inside loop
            for(let i = 0; i < files.length; i++) {
                $("#station").append('<option value="' + files[i] + (files[i] === current_station ? '" selected>' : '">') + files[i].replace(/_/g, " ") + "</option>");
            }

            let historyData = response['history_data'];

            $("#station_history").append(historyData);
        },
        error: function (response) {
            error_response.text('Error loading data');
          
            let output = "<table>";
            for(let i = 0; i < historyData.length; i++) {
                output += "<tr>";
                let s = historyData[i].split(",");
                for(let j = 0; j < s.length; j++) {
                    output += "<td>" + s[j] + "</td>";
                }
                output += "</tr>";
            }
            output += "</table>";
            $("#station_history").append(output);
        }
    });
});