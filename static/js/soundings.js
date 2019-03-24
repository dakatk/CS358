$(function () {

  const csrf_token = $('[name=csrfmiddlewaretoken]').val();

  $.ajax({
    type: 'POST',
    url: url,
    dataType: 'JSON',
    data: data,
    headers: {
      'X-CSRFTOKEN': csrf_token
    },
    success: function(response) {

      let image_preload = $('#preload');
    }
  });
})