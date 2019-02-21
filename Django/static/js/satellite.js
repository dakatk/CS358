$(function () {
  const csrf_token = $('[name=csrfmiddlewaretoken]').val();
  const satellite_channel = $('[name=satellite_channel]').val();

  var loop_delay = 100;

  var image_cycles = [''];
  var image_index = 0;

  function loop_images() {

    let image_tag = $('#animate_loop #current_image');
    image_tag.attr('src', image_cycles[image_index]);

    image_index --;
    if (image_index <= 0) {
      image_index = image_cycles.length - 1;
    }

    image_tag.animate({}, {
      duration: loop_delay,
      complete: function () {
        window.setTimeout(loop_images, loop_delay);
      }
    });
  }

  $.ajax({
    type: 'POST',
    url: 'image_desc/',
    dataType: 'JSON',
    data: {
      'channel': satellite_channel
    },
    headers: {
      'X-CSRFTOKEN': csrf_token
    },
    success: function(response) {

      image_cycles = response['image_cycle'];
      image_index = image_cycles.length - 1;

      loop_images();
    }
  });
});