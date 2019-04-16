$.fn.jsonify_form = function () {

    let unindexed_array = $(this).serializeArray();
    let indexed_array = {};

    $.map(unindexed_array, function (data, i) {
        indexed_array[data['name']] = data['value'];
    });

    return indexed_array;
};

$.fn.jsonify_file_form = function () {

    let form_data = new FormData();

    $.each($(this).find('input[type="file"]'), function (i, el) {

        $.each($(el)[0].files, function (i, file) {
            form_data.append(el.name, file, file.name);
        });
    });

    return form_data
};