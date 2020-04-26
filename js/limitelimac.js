function setCookie(key, val, expireHours) {
  var d = new Date();
  d.setTime(d.getTime() + (expireHours*60*60*1000));
  document.cookie = `${key}=${val}; expires=${d.toUTCString()}`;
}

function getCookie(key) {
  var name = key + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
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