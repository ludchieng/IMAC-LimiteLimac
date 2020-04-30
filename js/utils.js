function setCookie(key, val, expireHours) {
  var d = new Date();
  d.setTime(d.getTime() + (expireHours * 60 * 60 * 1000));
  document.cookie = `${key}=${val}; expires=${d.toUTCString()}`;
}

function getCookie(key) {
  var name = key + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return null;
}

function isCertifiedConnection() {
  return location.protocol === 'https:';
}

function changeSVGtoInlineSVG(selector) {
  let e = jQuery(selector);
  let classes = e.attr('class');
  let src = e.attr('src');

  jQuery.get(src, function (data) {
    // Get the SVG tag, ignore the rest
    let svg = jQuery(data).find('svg');

    // Add replaced image's ID to the new SVG
    if (typeof id !== 'undefined') {
      svg = svg.attr('id', id);
    }
    // Add replaced image's classes to the new SVG
    if (typeof classes !== 'undefined') {
      svg = svg.attr('class', classes + ' replaced-svg');
    }

    // Remove any invalid XML tags as per http://validator.w3.org
    svg = svg.removeAttr('xmlns:a');

    // Replace image with new SVG
    e.replaceWith(svg);

  }, 'xml');
}