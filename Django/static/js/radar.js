$(function () {

  const radar_type = $('[name=radar_type]').val();

  require.config({
    baseUrl: '/static/js/modules',
    paths: {
      'images_module': 'images_module'
    }
  });

  require([
    'images_module'
  ], function (images_module) {
    images_module.request_image_loop('image_desc/', { 'radar_type': radar_type }, 100);
  });
});
