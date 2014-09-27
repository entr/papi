(function () {

  // Utils object.
  var Utils = {};

  // Hook up the WordPress media editor.
  Utils.wpMediaEditor = function ($target) {
    var uploader = wp.media({
      multiple: false
    }).on('select', function () {
      var attachment = uploader.state().get('selection').first().toJSON();
      if (attachment !== null) {
        var ext = /\.(jpeg|jpg|gif|png)/.exec(attachment.url)[0];
        attachment.thumbnail = attachment.url.replace(ext, '-150x150' + ext);
        if (typeof $target === 'function') {
          $target(attachment, Utils.isImage(attachment.url));
        } else {
          $target.val(attachment.url);
        }
      }
    }).on('escape', function () {
      if (typeof $target === 'function') {
        $target(null, false);
      }
    }).open();
  };

   // Check if given string is a image via regex.
  Utils.isImage = function (url) {
    return /\.(jpeg|jpg|gif|png)$/.test(url.toLowerCase());
  };

  // Add utils to the papi object.
  window.papi.Utils = Utils;

}());
