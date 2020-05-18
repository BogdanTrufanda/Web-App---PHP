function get_cookie_value(name) {
  var match = document.cookie.match(new RegExp(name + '=([^;]+)'));
  if (match)
      return match;
}

var countDownDate = get_cookie_value("time_cookie")[1]; 

countDownDate = parseInt(countDownDate);
var x = setInterval(function() {

    var now = +new Date();
    var distance = countDownDate - now;
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";

    if (distance < 0)
    {
        clearInterval(x);
        document.getElementById("demo").innerHTML = " ";
        window.location.replace("test.php");
    }
}, 1000);
