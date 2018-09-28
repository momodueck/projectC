<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/style.css">

    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/d3.v4.js"></script>

  </head>
  <body>


  <div id="wrapper">
    <div class="overlay">
      <nav class="navbar navbar-inverse navbar-fixed-top sidebar-wrapper"  role="navigation">
          <div class="input-group">
            <input id="search-input" type="text" autocomplete="off" class="form-control" placeholder="Search.." name="search">
            <div class="input-group-append">
              <button class="btn btn-light" id="search" ><img class="icon" src="/img/search.svg" alt=""></button>
            </div>
          </div>
          <div id="results">
          </div>
        @yield('nav')
      </nav>
      <div class="close_overlay"></div>
    </div>
    <div id="page-content-wrapper">
      <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
        <span class="hamb-top"></span>
        <span class="hamb-middle"></span>
        <span class="hamb-bottom"></span>
      </button>

      <header>
        <a href="/"><img src="{{asset('img/favicon2.svg')}}" alt=""></a>
      </header>
      <div class="content">
        @yield('content')
      </div>


    </div>
  </div>

    <script type="text/javascript" src="/js/main.js"></script>
  </body>
</html>
