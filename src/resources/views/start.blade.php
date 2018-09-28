<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project C</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/start.css">

    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/d3.v4.js"></script>


  </head>
  <body>

      <img id="main_logo" src="{{asset('img/logo2.svg')}}" alt="">

      <div class="content">
        <div class="input-group">
          <input id="search-input" autocomplete="off" type="text" class="form-control" placeholder="Search.." name="search">
          <div class="input-group-append">
            <button class="btn btn-light" id="search" ><img class="icon" src="/img/search.svg" alt=""></button>
          </div>
        </div>
        <div id="results">
        </div>

      </div>
      <div id="add_div">
          <a href="/add">
            <img src="/img/add.svg" class="icon"alt="">
          </a>
          <p id="add_p">Add A new Song</p>
      </div>

    <script type="text/javascript" src="/js/main.js"></script>
    <script type="text/javascript" src="/js/start.js"></script>

  </body>
</html>
