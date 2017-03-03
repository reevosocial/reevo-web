define(['require', 'jquery', 'elgg'], function(require, $, elgg) {
  $('#yourls-url').attr('data-url',document.URL);
  $('#yourls-url').prop('readonly', true);
  $(document).on('click', "#yourls-icon", function(e) {
      e.preventDefault();

      var url = encodeURI($('#yourls-url').attr('data-url'));
      var api_key = $('#yourls-url').attr('data-apikey');
      var api_url  = $('#yourls-url').attr('data-server');

      var response = $.get( api_url, {
          signature: api_key,
          action:   "shorturl",
          format:   "json",
          url:      url
          },
          // callback function that will deal with the server response
          function( data) {
              // for instance, return short URL
              $("#yourls-url").val(data.shorturl);
              $("#yourls-url").focus();
              $("#yourls-url").select();

          }
      );
    $("#yourls-url").focus();
    $("#yourls-url").select();

  });
});
