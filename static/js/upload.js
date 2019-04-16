$(function () {

  const csrf_token = $('[name=csrfmiddlewaretoken]').val();
  const upload_button = $('#upload_files');
  const form = $('#sounding_data');

  /*function serialize_file_form(form) {

      let form_data = new FormData();

      $.each(form.find('input[type="file"]'), function(i, el) {

          $.each($(el)[0].files, function (i, file) {
              form_data.append(el.name, file, file.name);
          });
      });

      return form_data
  }*/

  upload_button.on('click', function () {

      $.ajax({
          type: 'POST',
          url: 'files/',
          contentType: false,
          processData: false,
          data: form.jsonify_file_form(),//serialize_file_form(form),
          headers: {
              'X-CSRFTOKEN': csrf_token
          }
      });
  });
});