$(function () {
  
  const csrf_form = $('#csrf_form');
  const image_tag = $('#show_image');

  const options = $('#options');
  const error_response = $('#error_response');
  const sounding_title = $('#sounding_title');

  const raw_data = $('#raw_data');
  const standard_levels = $('#standard_levels');
  const siginificant_levels = $('#siginificant_levels');
  const sharppy_ready = $('#sharppy_ready');
  const sounding_summary = $('#sounding_summary');
  const flight_path = $('#flight_path');
  
  var image_selects = [];
  var launch_files = [];
  
  options.on('change', function () {
    
    let val = this.value;
    
    if (val >= image_selects.length) {
      return false;
    }
    image_tag.html(image_selects[val]);

    // .dat
    // _STDLVLS.txt
    // _SIGLVLS.txt
    // _SHARPPY.txt
    // _SUMMARY.txt
    // _Path.png

    raw_data.attr('href', launch_files[val] + '.dat');
    standard_levels.attr('href', launch_files[val] + '_STDLVLS.txt');
    siginificant_levels.attr('href', launch_files[val] + '_SIGLVLS.txt');
    sharppy_ready.attr('href', launch_files[val] + '_SHARPPY.txt');
    sounding_summary.attr('href', launch_files[val] + '_SUMMARY.txt');
    flight_path.attr('href', launch_files[val] + '_Path.png');

    let header = $(this).children("option:selected").text();   

    sounding_title.text('Sounding taken ' + header);
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
      image_selects = new Array(image_urls.length);
      
      for (let i in launch_files) {
        image_preload.append('<div style="background-image: ' + launch_files[i] + '_KVUM.png;"></div>');
      }
      
      for (let i in launch_files) {
        
        image_selects[i] = new Image();
        image_selects[i].src = launch_files[i] + '_KVUM.png';
      }
      image_tag.html(image_selects[0]);
    },
    error: function (response) {
      error_response.text('Error loading images');
    }
  });
});
