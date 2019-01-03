<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Brandon Okeke - Oh Boy</title>
    <meta name="description" content="I'm Brandon Okeke. A Computer Science undergraduate and a creative who hasn't created anything">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<header>
    <div class="container">
        <nav>
            <ul>
                <li><a href="" class="last-nav-item">the big lists</a></li>
                <li><a href="">work</a></li>
                <li><a href="">blog</a></li>
                <li><a href="">about</a></li>
                <!-- <li class="brawrdon"><a href="/">brawrdon</a></li> -->
            </ul>
        </nav>
    </div>
</header>
<section class="jumbotron">
    <div class="container">
        <h1>Brandon Okeke</h1>
        <h2>Computer Science Undergraduate</h2>
    </div>
</section>
<section class="brawrdobot">
    <div class="container">
        <h3>BrawrdonBot</h3>
        <p class="section-text">A Twitter bot that turns your messages into works of art.</p>
        <div class="row input">
            <div class="nine columns">
                <input id="message" class="message-text u-full-width" placeholder="Enter your message here..." type="text" maxlength="280">
            </div>
            <div class="three columns">
                <button id="send" class="button-primary u-full-width right">Send</button>
            </div>
        </div>
        <p class="section-text small">(He doesn't do that just yet)</p>
    </div>
</section>
<script>
    let button = document.getElementById("send");
    let input = document.getElementById("message");

    // Set up request
    let request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                input.value = 'Your message has been sent! You can send another one in a sec.';
            } else {
                input.value = 'There was a problem! You can send another message in a sec.';
            }

            setTimeout(function () {
                input.disabled = false;
                button.disabled = false;
                input.value = "";
            }, 3000);
        }
    };

    // Perform request on button click
    button.addEventListener("click", function () {
        request.open('POST', 'https://api.brawrdon.com/twitter/post/brawrdonbot', true);
        request.setRequestHeader('Content-Type', 'application/json');
        request.send(JSON.stringify({
            message: input.value
        }));

        input.disabled = true;
        button.disabled = true;
    });
</script>
</body>
</html>
