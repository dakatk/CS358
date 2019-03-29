$(function () {
  
  const model_type = $('[name=model_type]').val();
  
  require.config({
    
    baseUrl: '/static/js/modules',
    paths: {
      'loop': 'loop'
    }
  });
  
  require([
    'loop'
  ], function (module) {
    
    module.request_image_loop('/wrf_model/images/', { 'model_type': model_type }, 5);
    module.ui_setup();
  });
});
