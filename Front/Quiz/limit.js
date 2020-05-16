            var javaScriptVar = "<?php echo $_SESSION['timp']; ?>";
//            var today = new Date();
//            var date = today.getFullYear() + '-' + (today.getMonth()+ 1) + '-' + today.getDate();
//            var time = today.getHours() + ":" + (today.getMinutes() + ) + ":" + today.getSeconds();
//            var date_time = date + ' ' + time;
//
//            var countDownDate = new Date(date_time).getTime();
            var x = setInterval(function() {

                var now = new Date().getTime();
                window.alert(now);
                window.alert(javaScriptVar);
                var distance = javaScriptVar - now;

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

