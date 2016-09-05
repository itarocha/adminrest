@extends('layouts.default')

@section('content')

{!! $text !!}

<div>
  <iframe height="150"
     width="250"
     src="http://www.youtube.com/embed/m5Jmh9JKnyQ"
     frameborder="0"
     allowfullscreen="">
   </iframe>
</div>

<form method="GET" action="/login">
    <button class="button-primary">Login with Google</button>
</form>
@stop
