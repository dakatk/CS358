$(function () {

  const csrf_token = $('[name=csrfmiddlewaretoken]').val();
  const radar_type = $('[name=radar_type]').val();

  const loop_delay = 100;
  
  var image_cycles = [''];
  var image_index = 0;

  function loop_images() {

    let image_tag = $('#fade_loop #current_image');
    image_tag.attr('src', image_cycles[image_index]);
    
    image_index ++;
    if (image_index >= image_cycles.length) {
      image_index = 0;
    }

    window.setTimeout(function () {
        loop_images();
    }, loop_delay);
  }

  $.ajax({
    type: 'POST',
    url: 'image_desc/',
    dataType: 'JSON',
    data: {
      'radar_type': radar_type
    },
    headers: {
      'X-CSRFTOKEN': csrf_token
    },
    success: function(response) {

      image_cycles = response['image_cycle'];
      loop_images();
    }
  });
});
