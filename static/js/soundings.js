$(function () {

  const csrf_token = $('[name=csrfmiddlewaretoken]').val();
  const image_tag = $('#show_image');

  var image_selects = [];

  $('#options').on('change', function () {

    let val = this.value;

    if (val >= image_selects.length) {
      return false;
    }
    image_tag.html(image_selects[val]);
  });

  $.ajax({
    type: 'POST',
    url: url,
    dataType: 'JSON',
    data: data,
    headers: {
      'X-CSRFTOKEN': csrf_token
    },
    success: function (response) {

      let image_urls = response['image_cycle'];
      let image_preload = $('#preload');

      image_selects = new Array(image_urls.length);

      for (let i in image_urls) {
        image_preload.append('<div style="background-image: ' + image_urls[i] + ';"></div>');
      }

      for (let i in image_urls) {

        // image_preload.appendcss('background-image', image_urls[i]);

        image_selects[i] = new Image();
        image_selects[i].onload = function () {
          // TODO
        };
        image_selects[i].src = image_urls[i];
      }
    }
  });
})