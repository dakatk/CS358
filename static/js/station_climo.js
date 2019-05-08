$(function() {

    // TODO these should be derived from form data
    const current_station = $('[name=current_station]').val();
    const csrf_token = $('[name=csrfmiddlewaretoken]').val();

    const error_response = $('#error_response');

    //Ajax POST request for the different station options and the station history. Sent to station_climo/views.py
    $.ajax({
        type: 'POST',
        url: 'file_names/',
        dataType: 'json',
        data: {'current_station': current_station, 'csrfmiddlewaretoken': csrf_token},
        success: function(response) {

            //The names of the available station_climo files
            let files = response['file_names'];

            //Append all the options to the dropdown
            for(let i = 0; i < files.length; i++) {
                $("#station").append('<option value="' + files[i] + (files[i] === current_station ? '" selected>' : '">') + files[i].replace(/_/g, " ") + "</option>");
            }

            //The station history
            let historyData = response['history_data'];
            //The resultant string to be appended to the div with the station_history id
            let output = "<table>";

            //Loop to construct the station history HTML code
            for(let i = 0; i < historyData.length; i++) {
                output += "<tr>";
                let s = historyData[i].split(",");
                for(let j = 0; j < s.length; j++) {
                    output += "<td>" + s[j] + "</td>";
                }
                output += "</tr>";
            }
            output += "</table>";
            //Append the table to div station_history
            $("#station_history").append(output);
        },
        error: function (response) {
            error_response.text('Error loading data');
        }
    });
});