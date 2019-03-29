$(function () {
  
  const satellite_channel = $('[name=satellite_channel]').val();
  
  require.config({
    
    baseUrl: '/static/js/modules',
    paths: {
      'loop': 'loop'
    }
  });
  
  require([
    'loop'
  ], function (module) {
    
    module.request_image_loop('images/', { 'channel': satellite_channel }, 5);
    module.ui_setup();
  });
});
