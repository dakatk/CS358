define(function () {

  var image_cycles = [''];
  var image_index = 0;
  var interval = null;

  const image_tag = $('#animate_loop #current_image');

  function _loop_images() {

    image_tag.animate({}, {
      duration: 5,
      complete: function () {

        image_tag.attr('src', image_cycles[image_index]);
        image_index --;

        if (image_index <= 0) {
          image_index = image_cycles.length - 1;
        }
      }
    });
  }

  function _reset_interval (delay) {

    if (interval !== null) {
      clearInterval(interval);
    }
    interval = setInterval(_loop_images, delay);
  }

  return {

    reset_interval: _reset_interval,

    request_image_loop: function (url, data, delay) {

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

          image_cycles = response['image_cycle'];
          image_index = image_cycles.length - 1;

          _reset_interval(delay);
        }
      });
    }
  };
});