function get_cookie_value(name) {
  var timp = document.cookie.match(new RegExp(name + '=([^;]+)'));
  if (timp)
      return timp;
}

var countDownDate = get_cookie_value("time_cookie")[1]; 

countDownDate = parseInt(countDownDate);
var x = setInterval(function() {

    var now = +new Date();
    var distance = countDownDate - now;
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

    if (distance < 0)
    {
        clearInterval(x);
        document.getElementById("timer").innerHTML = " ";
        window.location.replace("test.php");
    }
}, 1000);
