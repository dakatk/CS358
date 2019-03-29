$(function () {
  
  const radar_type = $('[name=radar_type]').val();
  
  require.config({
    
    baseUrl: '/static/js/modules',
    paths: {
      'loop': 'loop'
    }
  });
  
  require([
    'loop'
  ], function (module) {
    
    module.request_image_loop('images/', { 'radar_type': radar_type }, 5);
    module.ui_setup();
  });
});
