$(function () {  require.config({    baseUrl: '/static/js/modules',    paths: {      'loop': 'loop'    }  });  require([    'loop'  ], function (module) {
    module.request_image_loop('images/', {}, 200);
    module.ui_setup();  });});