define(function () {

  const image_tag = $('#animate_loop');

  const start_button = $('#start_button');
  const stop_button = $('#stop_button');

  const forward_button = $('#forward_button');
  const back_button = $('#back_button');

  const frame_value = $('#frame_value');
  const speed_value = $('#speed_value');

  const dir_button = $('#direction');
  const playback_bar = $('#playback_bar');  var image_cycles = [];  var image_index = 0;

  var running = true;
  var forward = true;

  var interval;
  var speed;
  function _step_forward () {

    image_index --;    if (image_index <= 0) {      image_index = image_cycles.length - 1;    }
  }

  function _step_backward () {

    image_index ++;    if (image_index >= image_cycles.length) {      image_index = 0;    }
  }

  function _update_frame () {

    image_tag.html(image_cycles[image_index]);
    $('#playback_bar').val(image_index);
  }  function _loop_images () {

    if (running) {      _update_frame();

      if (forward) {
        _step_forward();
      }
      else {
        _step_backward();
      }
    }  }  function _reset_interval () {

    if (image_cycles.length === 0) {
      return;
    }

    let delay = Math.ceil(1000.0 / parseInt(speed_value.val()));    if (interval !== undefined) {      clearInterval(interval);    }    interval = setInterval(_loop_images, delay);  }  return {        ui_setup: function () {

      start_button.prop('disabled', true);
      back_button.prop('disabled', true);
      forward_button.prop('disabled', true);
      playback_bar.prop('disabled', true);
      frame_value.prop('disabled', true);              // Top      start_button.on('click', function (event) {
        start_button.prop('disabled', true);
        stop_button.prop('disabled', false);

        back_button.prop('disabled', true);
        forward_button.prop('disabled', true);
        playback_bar.prop('disabled', true);
        frame_value.prop('disabled', true);

        running = true;      });        stop_button.on('click', function (event) {        
        stop_button.prop('disabled', true);
        start_button.prop('disabled', false);

        back_button.prop('disabled', false);
        forward_button.prop('disabled', false);
        playback_bar.prop('disabled', false);
        frame_value.prop('disabled', false);

        running = false;      });        dir_button.on('click', function () {
        forward = !forward;
      });

      speed_value.on('change', function (event) {
        _reset_interval();
      }              // Bottom      back_button.on('click', function (event) {
        _step_backward();
        _update_frame();      });        forward_button.on('click', function (event) {
        _step_forward();
        _update_frame();      });        playback_bar.on('change', function (event) {        
        image_index = parseInt(playback_bar.val()) - 1;
        _update_frame();      });        frame_value.on('change', function (event) {        
        image_index = parseInt(frame_value.val()) - 1;
        _update_frame();      });    },    request_image_loop: function (url, data, init_speed) {      const csrf_token = $('[name=csrfmiddlewaretoken]').val();      $.ajax({        type: 'POST',        url: url,        dataType: 'JSON',        data: data,        headers: {          'X-CSRFTOKEN': csrf_token        },        success: function (response) {                      let image_urls = response['image_cycle'];          let image_preload = $('#preload');                    image_cycles = new Array(image_urls.length);

          frame_value.prop('max', image_urls.length);
          playback_bar.prop('max', image_urls.length);

          speed_value.val(init_speed);          for (let i in image_urls) {

            let preload_el = '<div style="background-image: url(' + image_urls[i] + ');"></div>';            image_preload.append($(preload_el));          }                    for (let i in image_urls) {            image_cycles[i] = new Image();            image_cycles[i].onload = function () {              // TODO            };                    image_cycles[i].src = image_urls[i]          }          image_index = image_cycles.length - 1;                    _reset_interval();        }      });    }  };});