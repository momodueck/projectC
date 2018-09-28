@extends('layouts.main')

@section('title','Change the Song')

@section('content')

<link rel="stylesheet" href="/css/add.css">

<form class="" action="/update" method="post">
  {{ csrf_field() }}
  <div class="px-2 px-md-5">
    <div class="form-group row mx-0">
        <div class="col-lg-5 px-0 pr-lg-3">
          <label for="title" class=" col-form-label">Title</label>
          <input name="title" type="text" class="form-control" id="title" placeholder="Title" value="{{$song->title}}">
        </div>
        <div class="col-lg-5 px-0 pr-lg-3">
          <label for="artist" class=" col-form-label">Artist</label>
          <input name="artist"type="text" class="form-control" id="artist" placeholder="Artist" value="{{$song->artist}}">
        </div>
        <div class="col-lg-1 px-0">
          <label for="capo" class=" col-form-label">Capo</label>
          <input name="capo" type="number" class="form-control pr-lg-0 " id="capo" placeholder="0" value="{{$song->capo}}">
        </div>
    </div>
    <div class="form-group" >
        <label for="numerator" class="col-form-label">Beat</label>
        <div class="row m-0">
          <input name="numerator" type="number" class="form-control col-2 col-md-1" id="numerator" placeholder="3" value="{{$song->beat}}{{ old('numerator') }}">
          <input type="text" readonly class="form-control-plaintext col-1 px-0 center" id="staticEmail" value="/">
          <input name="denominator"type="number" class="form-control col-2 col-md-1" id="denominator" placeholder="4" value="{{ old('denominator') }}">
        </div>
        <label for="bpm" class="col-form-label">bpm</label>
        <input name="bpm" type="number" class="form-control col-5 col-md-2" id="bpm" placeholder="90" value="{{ old('bpm') }}">
    </div>

    <div class="row mx-0">
      <div class="col-10 "></div>
      <div class="col-1">
        <button type="submit" class="btn btn-img mb-2"><img src="/img/forward.svg" alt=""></button>
      </div>
    </div>

  </div>

</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<footer></footer>

@endsection
