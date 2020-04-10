function $(el) {
    return document.getElementById(el);
  }
  var inp1 = $("inp1");
  var inp2 = $("inp2");
  var inp3 = $("inp3");
  var txt = $("txt");
  var view = $("view");
  var copy = $("copy");
  var root = document.documentElement;
  var h, s, l;
  h = [];
  s = [];
  l = [];
  
  function update() {
    h = [];
    s = [];
    l = [];
    for (var i = 0; i < 360; i++) {
      h.push("hsl(" + (i + 1) + ", " + 100 + "%, " + 50 + "%)");
    }
    for (var i = 0; i < 100; i++) {
      s.push("hsl(" + inp1.value + ", " + i + "%, 50%)");
      l.push("hsl(" + inp1.value + ", 100%, " + i + "%)");
    }
    inp1.style.background = "linear-gradient(to right, " + h.join(", ") + ")";
    inp2.style.background = "linear-gradient(to right, " + s.join(", ") + ")";
    inp3.style.background = "linear-gradient(to right, " + l.join(", ") + ")";
    txt.value =
      "hsl(" + inp1.value + ", " + inp2.value + "%, " + inp3.value + "%)";
    view.style.backgroundColor =
      "hsl(" + inp1.value + ", " + inp2.value + "%, " + inp3.value + "%)";
    root.style.setProperty("--color1", "hsl(" + inp1.value + ", 100%, 50%)");
    root.style.setProperty(
      "--color2",
      "hsl(" + inp1.value + ", " + inp2.value + "%, 50%)"
    );
    root.style.setProperty(
      "--color3",
      "hsl(" + inp1.value + ", 100%, " + inp3.value + "%)"
    );
    $("rgb").innerHTML = window.getComputedStyle(view).backgroundColor;
    var str = window.getComputedStyle(view).backgroundColor;
    str = str.replace("rgb", "");
    str = str.replace("(", "");
    str = str.replace(")", "");
    str = str.split(",");
    var hex = [0, 0, 0];
    hex[0] = parseFloat(str[0]).toString(16);
    hex[1] = parseFloat(str[1]).toString(16);
    hex[2] = parseFloat(str[2]).toString(16);
    
    if(hex[0].length < 2) {
      hex[0] = '0'+hex[0];
    }
    if(hex[1].length < 2) {
      hex[1] = '0'+hex[1];
    }
    if(hex[2].length < 2) {
      hex[2] = '0'+hex[2];
    }
  
    hex = "#" + hex.join("");
    $("hex").innerHTML = hex;
  }
  update();
  inp1.oninput = update;
  inp2.oninput = update;
  inp3.oninput = update;
  txt.oninput = convert;
  
  copy.onclick = function() {
    txt.select();
    txt.setSelectionRange(0, 99999);
    document.execCommand("copy");
  };
  
  function convert() {
    var str = this.value;
    str = str.replace("hsl", "");
    str = str.replace("(", "");
    str = str.replace(")", "");
    str = str.replace("%", "");
    str = str.replace("%", "");
    str = str.split(",");
    inp1.value = parseFloat(str[0]);
    inp2.value = parseFloat(str[1]);
    inp3.value = parseFloat(str[2]);
    update();
    console.log(inp2.value < parseFloat(str[1]));
  }
  