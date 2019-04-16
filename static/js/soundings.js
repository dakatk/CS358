$(function () {
  
  const csrf_form = $('#csrf_form');
  const image_tag = $('#show_image');
  
  var image_selects = [];
  
  $('#options').on('change', function () {
    
    let val = this.value;
    
    if (val >= image_selects.length) {
      return false;
    }
    image_tag.html(image_selects[val]);
  });

  /*function serialize_form_data (form) {

    let form_data = {};

    $.map(form.serializeArray(), function (data, i) {
      form_data[data['name']] = data['value'];
    });
    return form_data;
  }*/
  
  $.ajax({
    type: 'POST',
    url: 'images/',
    dataType: 'JSON',
    data: csrf_form.jsonify_form(),//serialize_form_data(csrf_form),
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
    }
  });
});
