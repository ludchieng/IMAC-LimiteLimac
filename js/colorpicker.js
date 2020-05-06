function ColorPicker(hex) {
  this.hex = hex;
  this.inp1 = jQuery("#inp1")[0];
  this.inp2 = jQuery("#inp2")[0];
  this.inp3 = jQuery("#inp3")[0];
  this.txt = jQuery("#txt")[0];
  this.view = jQuery("#view")[0];
  //this.copy = jQuery("copy");
  this.root = document.documentElement;
  this.h = [];
  this.s = [];
  this.l = [];

  this.init = () => {
    if (this.hex)
      var color = this.hexToHSL(this.hex);
    else
      var color = {h: 0, s: 0, l: .7};
    jQuery('#inp1').val(color.h * 360);
    jQuery('#inp2').val(color.s * 100);
    jQuery('#inp3').val(color.l * 100);
    this.updateColorPicker();
  };

  this.hexToHSL = (hex) => {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    r = parseInt(result[1], 16);
    g = parseInt(result[2], 16);
    b = parseInt(result[3], 16);
    r /= 255, g /= 255, b /= 255;
    var max = Math.max(r, g, b), min = Math.min(r, g, b);
    var h, s, l = (max + min) / 2;
    if (max == min) {
      h = s = 0; // achromatic
    } else {
      var d = max - min;
      s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
      switch (max) {
        case r: h = (g - b) / d + (g < b ? 6 : 0); break;
        case g: h = (b - r) / d + 2; break;
        case b: h = (r - g) / d + 4; break;
      }
      h /= 6;
    }
    var HSL = new Object();
    HSL['h'] = h;
    HSL['s'] = s;
    HSL['l'] = l;
    return HSL;
  }

  this.updateColorPicker = () => {
    this.h = [];
    this.s = [];
    this.l = [];
    for (var i = 0; i < 360; i++) {
      this.h.push("hsl(" + (i + 1) + ", " + 100 + "%, " + 50 + "%)");
    }
    for (var i = 0; i < 100; i++) {
      this.s.push("hsl(" + this.inp1.value + ", " + i + "%, 50%)");
      this.l.push("hsl(" + this.inp1.value + ", 100%, " + i + "%)");
    }
    this.inp1.style.background = "linear-gradient(to right, " + this.h.join(", ") + ")";
    this.inp2.style.background = "linear-gradient(to right, " + this.s.join(", ") + ")";
    this.inp3.style.background = "linear-gradient(to right, " + this.l.join(", ") + ")";
    this.txt.value =
      "hsl(" + this.inp1.value + ", " + this.inp2.value + "%, " + this.inp3.value + "%)";
    this.view.style.backgroundColor =
      "hsl(" + this.inp1.value + ", " + this.inp2.value + "%, " + this.inp3.value + "%)";
    this.root.style.setProperty("--color1", "hsl(" + this.inp1.value + ", 100%, 50%)");
    this.root.style.setProperty(
      "--color2",
      "hsl(" + this.inp1.value + ", " + this.inp2.value + "%, 50%)"
    );
    this.root.style.setProperty(
      "--color3",
      "hsl(" + this.inp1.value + ", 100%, " + this.inp3.value + "%)"
    );
    jQuery("#rgb").text(window.getComputedStyle(this.view).backgroundColor);
    var str = window.getComputedStyle(this.view).backgroundColor;
    str = str.replace("rgb", "");
    str = str.replace("(", "");
    str = str.replace(")", "");
    str = str.split(",");
    var hex = [0, 0, 0];
    hex[0] = parseFloat(str[0]).toString(16);
    hex[1] = parseFloat(str[1]).toString(16);
    hex[2] = parseFloat(str[2]).toString(16);

    if (hex[0].length < 2) {
      hex[0] = '0' + hex[0];
    }
    if (hex[1].length < 2) {
      hex[1] = '0' + hex[1];
    }
    if (hex[2].length < 2) {
      hex[2] = '0' + hex[2];
    }

    hex = "#" + hex.join("");
    jQuery("#hex").text(hex);
  }
  this.updateColorPicker();
  this.inp1.oninput = this.updateColorPicker;
  this.inp2.oninput = this.updateColorPicker;
  this.inp3.oninput = this.updateColorPicker;
  this.txt.oninput = this.convertColorPicker;

  /*copy.onclick = this.) {
    this.txt.select();
    this.txt.setSelectionRange(0, 99999);
    document.execCommand("copy");
  };*/

  this.convertColorPicker = () => {
    var str = this.value;
    str = str.replace("hsl", "");
    str = str.replace("(", "");
    str = str.replace(")", "");
    str = str.replace("%", "");
    str = str.replace("%", "");
    str = str.split(",");
    this.inp1.value = parseFloat(str[0]);
    this.inp2.value = parseFloat(str[1]);
    this.inp3.value = parseFloat(str[2]);
    this.updateColorPicker();
    console.log(this.inp2.value < parseFloat(str[1]));
  }

}