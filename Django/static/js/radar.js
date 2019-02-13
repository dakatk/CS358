$(function () {

  const csrfToken = $('[name=csrfmiddlewaretoken]').val();

  function loop_images(image_cycle) {

    function loop(i) {

      var image_path = image_cycle[i];
      var image = $('#radar_current_image');

      console.log(image_path);

      image.attr('src', image_path);
      image.animate(
	{}, 1000, 'linear', function () {
          if (i >= 23) {
            i = 0;
          }
          loop(i + 1);
        });
    }
    loop(0);
  }

  $.ajax({
    type: 'POST',
    url: 'image_desc/',
    dataType: 'JSON',
    headers: {
      'X-CSRFTOKEN': csrfToken
    },
    success: function(response) {
      console.log(response['image_cycle']);
      loop_images(response['image_cycle']);
    },
    error: function(response) {
      console.log(response);
    }
  });
});
