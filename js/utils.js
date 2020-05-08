function setCookie(key, val, expireHours) {
  var d = new Date();
  d.setTime(d.getTime() + (expireHours * 60 * 60 * 1000));
  document.cookie = `${encodeURIComponent(key)}=${encodeURIComponent(val)}; expires=${d.toUTCString()}`;
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

function delCookie(key) {
  document.cookie = `${µ(key)}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}

function isCertifiedConnection() {
  return location.protocol === 'https:';
}

function getParam(name) {
  let res;
  let tmp = [];
  location.search.substr(1).split("&").forEach((item) => {
    tmp = item.split("=");
    if (tmp[0] === name) res = decodeURIComponent(tmp[1]);
  });
  return res;
}

function µ(str) {
  // Escape < > chars
  return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function rgbToHex(rgb) {
  rgb = rgb.replace("rgb", "");
  rgb = rgb.replace("(", "");
  rgb = rgb.replace(")", "");
  rgb = rgb.split(",");
  var hex = [0, 0, 0];
  hex[0] = parseFloat(rgb[0]).toString(16).padStart(2, 0);
  hex[1] = parseFloat(rgb[1]).toString(16).padStart(2, 0);
  hex[2] = parseFloat(rgb[2]).toString(16).padStart(2, 0);
  return hex[0] + hex[1] + hex[2];
}