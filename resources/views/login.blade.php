@extends('layouts.default')

@section('content')

@if(isset($text))
{!! $text !!}
@endif

<form method="POST" action="/filter">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

   <!-- Isso gera $a = array(array('A','1'), array('B','2'), array('C','3')) -->

  <input type="text" name="a[0][]" value="A" />
  <input type="text" name="a[0][]" value="1" />
  <br/>

  <input type="text" name="a[1][]" value="B" />
  <input type="text" name="a[1][]" value="2" />
  <br/>

  <input type="text" name="a[2][]" value="C" />
  <input type="text" name="a[2][]" value="3" />
  <br/>
  <br/>

  <input type="text" name="produto[]" value="Produto 1" />
  <input type="text" name="produto[]" value="Produto 2" />
  <input type="text" name="produto[]" value="Produto 3" />
  <br/>

  @if(isset($campos))
  <p>{{count($campos)}} elementos</p>
  @foreach ($campos as $campo)
      <label>{{$campo->descricao}}: </label>
      <input type="text" name="q[]" value="{{ $campo->valor }}" />
      <br/>
  @endforeach
  @endif

  <button>Filter</button>
</form>



<!-- <form method="GET" action="/login">
    <input type="text" name="valor[]">
    <input type="text" name="valor[]">
    <button class="button-primary">Login with Google</button>
</form> -->

@stop
