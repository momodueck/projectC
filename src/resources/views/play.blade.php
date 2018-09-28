
      @extends('layouts.main')

      @section('title','Project C')

      @section('nav')
      <ul class="list-group">
        <a href="/edit/{{$song->id}}/0" id="edit-nav-entry" class="nav-a"><li class="list-group-item nav-li"><img class="menu-icon" src="/img/edit.svg" alt=""> Edit the Song</li></a>
        <a href="/add" class="nav-a"><li class="list-group-item nav-li"><img class="menu-icon" src="/img/create.svg" alt=""> Add A New Song</li></a>
      </ul>
      @endsection


      @section('content')

      <script type="text/javascript">

        let position = <?php if(isset($position)){echo($position);}else{echo (0);} ?>;
        let json = '{"id":"{{$song->id}}","title":"{{$song->title}}", "artist":"{{$song->artist}}","capo":"{{$song->capo}}","beat":"{{$song->beat}}","base":"{{$song->base}}","bpm":"{{$song->bpm}}","tabs":{!!$song->tabs!!}}';
        let song = JSON.parse(json);

      </script>
      <div class="main">
        <div id="progress_bar_div">
          <svg viewBox= "0 0 600 50" id="progress_bar" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;">
              <g>
                  <g id="Layer1">
                      <g>
                          <rect x="0" y="0" width="600" height="20.0169" style="fill:rgb(235,235,235);"/>
                      </g>
                      <g id="progress_bar_g">
                          <path  d="M15.6105,10.0085C15.6105,4.48095 11.1296,-8.88178e-16 5.60206,-8.88178e-16L-643.699,-8.88178e-16C-649.227,-8.88178e-16 -653.707,4.48095 -653.707,10.0085C-653.707,15.536 -649.227,20.0169 -643.699,20.0169L5.60206,20.0169C11.1296,20.0169 15.6105,15.536 15.6105,10.0085Z" style="fill:rgb(37,172,255);"/>
                      </g>
                  </g>
              </g>
          </svg>
        </div>
        <div class="active">
          <div id="chords">

          </div>
          <div id="lyrics">

          </div>
        </div>
        <div class="preview">
          <div id="preview_chords">

          </div>
          <div id="preview_lyrics">

          </div>
        </div>

        <div class="lower_button">
          <img id="play_pause_button" class="lower_button_img" src="/img/play.png" alt="">
        </div>
      </div>
      <div id="scroll_menu">
        <input id="scroll_menu_slider" class="slider" type="range" name="" value="0" step="1">
        <img id="scroll_menu_close" src="/img/close.svg" alt="">
      </div>
      <div id="tempo_menu">
        <img id="tempo_menu_plus" src="/img/plus.svg" alt="">
        <img id="tempo_menu_minus" src="/img/minus.svg" alt="">
        <img id="tempo_menu_close" src="/img/close.svg" alt="">
        <p id="tempo_menu_bpm_p"><span id="tempo_menu_bpm_value"></span> bmp</p>
      </div>
      <footer>
        <nav>
          <div class="row nav-wrapper">
            <div class="col-3">

            </div>


            <div class="col-3">
              <img id="nav_count_menu_button" class="nav-icon" src="{{asset('img/count.svg')}}" alt="">
              <audio id="drum">
                <source src="/media/drum.ogg" type="audio/ogg">
                <source src="/media/drum.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
              </audio>
            </div>
            <div class="col-3">
              <img id="nav_tempo_menu_button" class="nav-icon" src="{{asset('img/note.svg')}}" alt="">
            </div>
            <div class="col-3">
              <img id="nav_scroll_menu_button" class="nav-icon" src="{{asset('img/swap.svg')}}" alt="">
            </div>
          </div>
        </nav>
      </footer>

      <script type="text/javascript" src="/js/index.js"></script>

      @endsection
