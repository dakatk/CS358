$(function () {

  const csrf_token = $('[name=csrfmiddlewaretoken]').val();
  const radar_type = $('[name=radar_type]').val();
  const image_path = $('[name=image_path]').val();

  const loop_delay = 0;
  const loop_fade = 1000;
  
  var image_cycles = [''];
  var image_index = 0;

  /*
  var tag_first = 0;
  var tag_next = 1;
  */

  function loop_images() {

    let next_index = image_index + 1;
    if (next_index >= image_cycles.length) {
      next_index = 0;
    }

    let image_tags = $('#fade_loop img');

    image_tags.eq(image_index).fadeOut(loop_fade).end()
		.eq(next_index).hide().fadeIn(loop_fade, loop_images);

    
    image_index ++;
    if (image_index >= image_cycles.length) {
      image_index = 0;
    }

    /*
    let next_index = image_index + 1;
    if (next_index >= image_cycles.length) {
      next_index = 0;
    }

    var image_tags = $('#fade_loop img');

    image_tags.eq(tag_first).attr('src', image_cycles[image_index]);
    image_tags.eq(tag_next).attr('src', image_cycles[next_index]);

    image_tags.eq(tag_first).fadeOut(loop_fade).end()
		.eq(tag_next).hide().fadeIn(loop_fade, loop_images);

    tag_first = 1 - tag_first;
    tag_next = 1 - tag_next;
  
    image_index ++;
    if (image_index >= image_cycles.length) {
      image_index = 0;
    }
    */
  }

  $.ajax({
    type: 'POST',
    url: 'image_desc/',
    dataType: 'JSON',
    data: {
      'radar_type': radar_type,
      'image_path': image_path
    },
    headers: {
      'X-CSRFTOKEN': csrf_token
    },
    success: function(response) {

      image_cycles = response['image_cycle'];
      for (i in image_cycles) {
        let tag = '<img ';
        if (i !== 0) {
          tag += 'style="display: none;"';
        }
	$('#fade_loop').append(tag + ' src="' + image_cycles[i] + '" />');
      }
      loop_images();
    }
  });
});
