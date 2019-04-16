$(function () {
  
  const csrf_form = $('#csrf_form');
  const image_tag = $('#show_image');

  const error_response = $('#error_response');
  
  var image_selects = [];
  
  $('#options').on('change', function () {
    
    let val = this.value;
    
    if (val >= image_selects.length) {
      return false;
    }
    image_tag.html(image_selects[val]);
  });
  
  $.ajax({
    type: 'POST',
    url: 'images/',
    dataType: 'JSON',
    data: csrf_form.jsonify_form(),
    success: function (response) {
      
      let image_urls = response['image_selects'];
      let image_preload = $('#preload');
      
      image_selects = new Array(image_urls.length);
      
      for (let i in image_urls) {
        image_preload.append('<div style="background-image: ' + image_urls[i] + ';"></div>');
      }
      
      for (let i in image_urls) {
        
        image_selects[i] = new Image();
        image_selects[i].src = image_urls[i];
      }
      image_tag.html(image_selects[0]);
    },
    error: function (response) {
      error_response.text('Error loading images');
    }
  });
});
