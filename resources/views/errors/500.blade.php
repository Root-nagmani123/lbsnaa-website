<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Favicon icon-->
    <link rel="icon" type="image/png" href="{{ asset('admin_assets/images/favicon.ico') }}">

    <!-- darkmode js -->
    <script src="../assets/js/vendors/darkMode.js"></script>

    <!-- Libs CSS -->
    <link href="{{ asset('assets/fonts/feather/feather.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet" />


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">

    <title>500 Error | Lal Bahadur Shastri National Academy of Administration</title>
    <style>
    body background-color: rgb(51, 51, 51) width: 100vw height: 100vh color: white font-family: 'Arial Black'
    text-align: center display: flex justify-content: center align-items: center .error-num font-size: 8em .eye background: #fff border-radius: 50% display: inline-block height: 100px position: relative width: 100px &::after background: #000 border-radius: 50% bottom: 56.1px content: ''
    height: 33px position: absolute right: 33px width: 33px p margin-bottom: 4em a color: white text-decoration: none text-transform: uppercase &:hover color: lightgray
    </style>
</head>

<body>
    <div>
        <span class='error-num'>5</span>
        <div class='eye'></div>
        <div class='eye'></div>
        <p class='sub-text'>Oh eyeballs! Something went wrong. We're <i>looking</i> to see what happened.</p>
        <a href=''>Go back</a>
    </div>
</body>
<script>
$('body').mousemove(function(event) {
    var e = $('.eye');
    var x = (e.offset().left) + (e.width() / 2);
    var y = (e.offset().top) + (e.height() / 2);
    var rad = Math.atan2(event.pageX - x, event.pageY - y);
    var rot = (rad * (180 / Math.PI) * -1) + 180;
    e.css({
        '-webkit-transform': 'rotate(' + rot + 'deg)',
        'transform': 'rotate(' + rot + 'deg)'
    });
});
</script>

</html>