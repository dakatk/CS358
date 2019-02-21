$(function () {

  const satellite_channel = $('[name=satellite_channel]').val();

  require.config({
    baseUrl: '/static/js/modules',
    paths: {
      'images_module': 'images_module'
    }
  });

  require([
    'images_module'
  ], function (images_module) {
    images_module.request_image_loop('image_desc/', { 'channel': satellite_channel }, 100);
  });
});