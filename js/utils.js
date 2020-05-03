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

function µ(str) {
  // Escape < > chars
  return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}