<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>Document</title>
    </head>
    <body>
        <div class="container-fluid text-center">
            <div class="row content">
              <div class="col-sm-8 text-left">
                <h1>Welcome</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <hr>
                {{-- <a href="{{ url('add-blog-post-form') }}">Config App</a> --}}
                <a href="{{ url('infinitiscroll') }}">Config App</a>
                <a href="{{ url('check') }}">Test</a>
              </div>
            </div>
          </div>

          @include('infinite-scroll-config')




    </body>
</html>
