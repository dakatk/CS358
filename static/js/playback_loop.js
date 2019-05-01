$(function () {

  const image_tag = $('#animate_loop');

  const start_button = $('#start_button');
  const stop_button = $('#stop_button');

  const forward_button = $('#forward_button');
  const back_button = $('#back_button');

  const frame_value = $('#frame_value');
  const speed_value = $('#speed_value');

  const dir_button = $('#direction');
  const playback_bar = $('#playback_bar');

  const form_data = $('#send_data');
  const error_response = $('#error_response');
  
  var image_cycles = [];
  var image_index = 0;

  var running = false;
  var forward = true;

  var loaded = 0;

  var interval;

  function step_forward () {

    image_index ++;
    
    if (image_index >= image_cycles.length) {
      image_index = 0;
    }
  }

  function step_backward () {

    image_index --;
    
    if (image_index < 0) {
      image_index = image_cycles.length - 1;
    }
  }
  
  function update_frame () {
    
    image_tag.html(image_cycles[image_index]);

    playback_bar.val(image_index);
    frame_value.val(image_index);
  }
  
  function loop_images () {
    
    if (running) {
      
      update_frame();
      
      if (forward) {
        step_forward();
      }
      else {
        step_backward();
      }
    }
  }
  
  function reset_interval () {

    if (image_cycles.length === 0) {
      return;
    }
    
    let delay = Math.ceil(1000.0 / parseInt(speed_value.val()));
    
    if (interval !== undefined) {
      clearInterval(interval);
    }
    interval = setInterval(loop_images, delay);
  }

  function ui_setup () {
      
    // Top
    start_button.on('click', function () {
        
      start_button.prop('disabled', true);
      stop_button.prop('disabled', false);
        
      back_button.prop('disabled', true);
      forward_button.prop('disabled', true);

      playback_bar.prop('disabled', true);
      frame_value.prop('disabled', true);
        
      running = true;
    });
      
    stop_button.on('click', function () {
        
      stop_button.prop('disabled', true);
      start_button.prop('disabled', false);
        
      back_button.prop('disabled', false);
      forward_button.prop('disabled', false);

      playback_bar.prop('disabled', false);
      frame_value.prop('disabled', false);
        
      running = false;
    });
      
    dir_button.on('click', function () {
      forward = !forward;
    });
      
    speed_value.on('change', function () {
      reset_interval();
    });
      
    // Bottom
    back_button.on('click', function () {
        
      step_backward();
      update_frame();
    });
      
    forward_button.on('click', function () {
        
      step_forward();
      update_frame();
    });
      
    playback_bar.on('input', function () {
        
      image_index = parseInt(playback_bar.val()) - 1;

      image_tag.html(image_cycles[image_index]);
      frame_value.val(image_index + 1);
    });
      
    frame_value.on('input', function () {
        
      image_index = parseInt(frame_value.val()) - 1;

      image_tag.html(image_cycles[image_index]);
      playback_bar.val(image_index + 1);
    });
  }

  const url = form_data.attr('action');

  $.ajax({

    type: 'POST',
    url: url,
    dataType: 'JSON',
    data: form_data.jsonify_form(),
    success: function (response) {
          
      let image_urls = response['image_cycle'];
          
      image_cycles = new Array(image_urls.length);
          
      frame_value.prop('max', image_urls.length);
      playback_bar.prop('max', image_urls.length);
          
      for (let i in image_urls) {
            
        image_cycles[i] = new Image();
        
        image_cycles[i].onload = function () { 

          if (this.complete) {
            loaded ++; 
          }

          // buffering
          if (loaded == image_cycles.length) {
            running = true;
          }
        };

        image_cycles[i].src = image_urls[i];
      }
          
      image_index = image_cycles.length - 1;

      let loading_gif = new Image();
      loading_gif.src = '/static/gifs/loading.gif';

      setTimeout(function () {

        // update_frame();
        image_tag.html(loading_gif);
        reset_interval();

      }, 100);
    },
    error: function (response) {
      error_response.text('Error loading images');
    }
  });

  ui_setup();
});
