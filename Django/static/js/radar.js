$(function () {
  $.ajax({
         type: 'POST',
         url: 'image_desc',
         dataType: 'JSON',
         success: function(response) {
            console.log(response);
         }
         });
  });
