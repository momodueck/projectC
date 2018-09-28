@extends('layouts.main')

@section('title','Project C')


@section('nav')

  <ul class="list-group">
    <a href="/play/{{$song->id}}/0" id="play-nav-entry" class="nav-a"><li class="list-group-item nav-li"><img class="menu-icon" src="/img/play.svg" alt=""> Play the Song</li></a>
    <a href="/add" class="nav-a"><li class="list-group-item nav-li"><img class="menu-icon" src="/img/create.svg" alt=""> Add A New Song</li></a>
  </ul>

@endsection





@section('content')
<script type="text/javascript">

  let position = <?php if(isset($position)){echo($position);}else{echo (0);} ?>;
  let json = '{"id":"{{$song->id}}","title":"{{$song->title}}", "artist":"{{$song->artist}}","capo":"{{$song->capo}}","beat":"{{$song->beat}}","base":"{{$song->base}}","bpm":"{{$song->bpm}}","tabs":{!!$song->tabs!!}}';
  let song = JSON.parse(json);

</script>
<link rel="stylesheet" href="/css/edit.css">

<div class="main">

  <div class="active">


    <div id="chords">

    </div>

    <div id="del-button-flex-container">

    </div>
    <div id="add-button-flex-container">

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
    <img id="swap_button" class="lower_button_img" src="/img/swap.png" alt="">
  </div>
</div>
<footer>
  <nav>
    <div class="row nav-wrapper">
      <div class="col-3">

      </div>
      <div class="col-2">
        <form class="" action="#" method="post">
          <meta name="csrf-token" content="{{ csrf_token() }}">
          <img id="nav_save_menu_button" class="nav-icon" src="{{asset('img/save.svg')}}" alt="">
          <img id="nav_save_menu_success" style="display:none;" class="nav-icon" src="{{asset('img/check.svg')}}" alt="">
          <img id="nav_save_menu_fail" style="display:none;" class="nav-icon" src="{{asset('img/alarm.svg')}}" alt="">
        </form>
      </div>

      <div class="col-2">
        <img id="nav_back_menu_button" class="nav-icon" src="{{asset('img/backwards.svg')}}" alt="">
      </div>
      <div class="col-2">
        <img id="nav_forward_menu_button" class="nav-icon" src="{{asset('img/forward.svg')}}" alt="">
      </div>
      <div class="col-3">
        <img id="nav_dropup_menu_button" class="nav-icon" src="/img/dropup.svg" alt="">
        <img id="nav_dropdown_menu_button" class="nav-icon" src="/img/dropdown.svg" alt="">
      </div>
    </div>
  </nav>
</footer>
<div id="dropup" style="bottom: -600px; display: none;">
  <form class="" action="#" method="post">

    <div class="px-2 px-md-5">
      <div class="form-group row mx-0">
          <div class="col-lg-5 px-0 pr-lg-3">
            <label for="title" class=" col-form-label">Title</label>
            <input required name="title" type="text" class="form-control" id="title" placeholder="Title" value="{{$song->title}}">
          </div>
          <div class="col-lg-5 px-0 pr-lg-3">
            <label for="artist" class=" col-form-label">Artist</label>
            <input required name="artist"type="text" class="form-control" id="artist" placeholder="Artist" value="{{$song->artist}}">
          </div>
          <div class="col-lg-1 px-0">
            <label for="capo" class=" col-form-label">Capo</label>
            <input required name="capo" type="number" class="form-control pr-lg-0 " id="capo" placeholder="0" value="{{$song->capo}}">
          </div>
      </div>
      <div class="form-group" >
          <label for="numerator" class="col-form-label">Beat</label>
          <div class="row m-0">
            <input required name="numerator" type="number" class="form-control col-2 col-md-1" id="numerator" placeholder="3" value="{{$song->beat}}">
            <input type="text" readonly class="form-control-plaintext col-1 px-0 center" value="/">
            <input required name="denominator"type="number" class="form-control col-2 col-md-1" id="denominator" placeholder="4" value="{{$song->base}}">
          </div>
          <label for="bpm" class="col-form-label">bpm</label>
          <input required name="bpm" type="number" class="form-control col-5 col-md-2" id="bpm" placeholder="90" value="{{$song->bpm}}">
      </div>

    </div>

  </form>
</div>

  <script type="text/javascript" src="/js/edit.js"></script>

@endsection
