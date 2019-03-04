﻿define(function () {  var image_cycles = [''];  var image_index = 0;  var interval = null;  const image_tag = $('#animate_loop');  function _loop_images() {    /*    image_tag.animate({}, {      duration: 1,      complete: function () {*/        image_tag.html(image_cycles[image_index]);        image_index --;        if (image_index <= 0) {          image_index = image_cycles.length - 1;        }    /*      }    });*/  }  function _reset_interval (delay) {    if (interval !== null) {      clearInterval(interval);    }    interval = setInterval(_loop_images, delay);  }  return {    reset_interval: _reset_interval,    request_image_loop: function (url, data, delay) {      const csrf_token = $('[name=csrfmiddlewaretoken]').val();      $.ajax({        type: 'POST',        url: url,        dataType: 'JSON',        data: data,        headers: {          'X-CSRFTOKEN': csrf_token        },        success: function(response) {                      let image_urls = response['image_cycle'];          let image_preload = $('#preload');                    image_cycles = new Array(image_urls.length);                    for (let i in image_urls) {                        image_cycles[i] = new Image();            image_cycles[i].onload = function () {                image_preload.css('background', 'url(' + image_urls[i] + ')');            };                    image_cycles[i].src = image_urls[i]          }          image_index = image_cycles.length - 1;                    _reset_interval(delay);        }      });    }  };});