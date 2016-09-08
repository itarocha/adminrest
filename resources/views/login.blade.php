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

  <!--
  <input type="text" name="produto[]" value="Produto 1" />
  <input type="text" name="produto[]" value="Produto 2" />
  <input type="text" name="produto[]" value="Produto 3" />
  <br/>

  <!-- produto 1 -->
  <!--
  <input type="text" name="produto[0][nome]" value="nome do produto" />
  <input type="text" name="produto[0][valor]" value="valor do produto" />
  <input type="text" name="produto[0][codigo]" value="codigo do produto" /> -->

  <!-- produto 2 -->
  <!--
  <input type="text" name="produto[1][nome]" value="nome do produto" />
  <input type="text" name="produto[1][valor]" value="valor do produto" />
  <input type="text" name="produto[1][codigo]" value="codigo do produto" /> -->

  <!-- produto 3 -->
  <!--
  <input type="text" name="produto[2][nome]" value="nome do produto" />
  <input type="text" name="produto[2][valor]" value="valor do produto" />
  <input type="text" name="produto[2][codigo]" value="codigo do produto" /> -->

  <!-- if(!empty($_POST['produto']) && is_array($_POST['produto'])){
    foreach($_POST['produto'] as $item) {
      echo $item['nome'], ' com valor ', $item['valor'], ' e codigo ', $item['codigo'], '<br />', PHP_EOL;
    }
  } -->

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
