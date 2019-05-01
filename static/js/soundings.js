$(function () {
  
  const csrf_form = $('#csrf_form');
  const image_tag = $('#show_image');

  const options = $('#options');
  const error_response = $('#error_response');
  const sounding_title = $('#sounding_title');

  const raw_data = $('#raw_data');

  const standard_levels = $('#standard_levels');
  const significant_levels = $('#significant_levels');

  const sharppy_ready = $('#sharppy_ready');
  const sounding_summary = $('#sounding_summary');

  const flight_path = $('#flight_path');
  
  var image_selects = [];
  var launch_files = [];

  function update_dl_links(index) {

    // .dat
    raw_data.attr('href', launch_files[index] + '.dat');

    // _STDLVLS.txt
    standard_levels.attr('href', launch_files[index] + '_STDLVLS.txt');

    // _SIGLVLS.txt
    significant_levels.attr('href', launch_files[index] + '_SIGLVLS.txt');

    // _SHARPPY.txt
    sharppy_ready.attr('href', launch_files[index] + '_SHARPPY.txt');

    // _SUMMARY.txt
    sounding_summary.attr('href', launch_files[index] + '_SUMMARY.txt');

    // _Path.png
    flight_path.attr('href', launch_files[index] + '_Path.png');
  }

  function update_header() {

    let header = options.children("option:selected").text();   

    sounding_title.text('Sounding taken ' + header);
  }
  
  options.on('change', function () {
    
    let val = this.value;
    
    if (val >= image_selects.length) {
      return false;
    }
    image_tag.html(image_selects[val]);

    update_dl_links(val);
    update_header();
  });

  sounding_title.text('Sounding taken ' + options.children("option:selected").text());
  
  $.ajax({
    type: 'POST',
    url: 'images/',
    dataType: 'JSON',
    data: csrf_form.jsonify_form(),
    success: function (response) {
      
      let image_preload = $('#preload');
      
      launch_files = response['launch_files'];
      image_selects = new Array(launch_files.length);

      update_dl_links(launch_files.length - 1);
      
      for (let i in launch_files) {
        image_preload.append('<div style="background-image: ' + launch_files[i] + '_KVUM.png;"></div>');
      }
      
      for (let i in launch_files) {
        
        image_selects[i] = new Image();
        image_selects[i].src = launch_files[i] + '_KVUM.png';
      }

      $('#options option[value="' + (image_selects.length - 1) + '"]').prop('selected', true);
      $('#options option[value="' + 0 + '"]').prop('selected', false);

      update_header();

      image_tag.html(image_selects[image_selects.length - 1]);
    },
    error: function (response) {
      error_response.text('Error loading images');
    }
  });
});
