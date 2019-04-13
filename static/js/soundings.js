$(function () {
  
  const csrf_token = $('[name=csrfmiddlewaretoken]').val();
  const image_tag = $('#show_image');
  
  let image_selects = [];
  
  $('#options').on('change', function (event) {
    
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
    data: {},
    headers: {
      'X-CSRFTOKEN': csrf_token
    },
    success: function (response) {
      
      let image_urls = response['image_selects'];
      let image_preload = $('#preload');
      
      image_selects = new Array(image_urls.length);
      
      for (let i in image_urls) {
        image_preload.append('<div style="background-image: ' + image_urls[i] + ';"></div>');
      }
      
      for (let i in image_selects) {
        
        image_selects[i] = new Image();
        image_selects[i].onload = function () {
          // TODO
        };
        image_selects[i].src = image_urls[i];
      }
      image_tag.html(image_selects[0]);
    }
  });
});
