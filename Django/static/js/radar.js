$(function () {

  const csrf_token = $('[name=csrfmiddlewaretoken]').val();
  const static_url = $('[name=static_url]').val();
  const radar_type = $('[name=radar_type]').val();

  const loop_delay = 50;
  const loop_fade = 500;
  
  var image_cycles = [''];
  var image_index = 0;

  var tag_first = 0;
  var tag_next = 1;
  
  function loop_images() {

    var next_index = image_index + 1;
    if (next_index >= image_cycles.length) {
      next_index = 0;
    }

    var image_tags = $('#fade_loop img');

    image_tags.eq(tag_first).attr('src', static_url + image_cycles[image_index]);
    image_tags.eq(tag_next).attr('src', static_url + image_cycles[next_index]);

    image_tags.eq(tag_first).delay(loop_delay).fadeOut(loop_fade).end()
		.eq(tag_next).delay(loop_delay).hide().fadeIn(loop_fade, loop_images);

    tag_first = 1 - tag_first;
    tag_next = 1 - tag_next;
  
    image_index ++;
    if (image_index >= image_cycles.length) {
      image_index = 0;
    }
  
    /*
    // lightwieght image loop:

    window.setTimeout(
      function () {
        loop_images();
      }, loop_delay);*/
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
