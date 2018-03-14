@extends('layouts.app')

@section('content')
  <header class="page-header">
    <h2>마크다운 뷰어</h2>
  </header>

  <div class="row">
    <div class="col-md-3 col-lg-3 docs__sidebar">
      <aside>
        {!! $index !!}
      </aside>
    </div>

    <div class="col-md-9 col-lg-9 docs__content">
      <article>
        {!! $content !!}
      </article>
    </div>
  </div>
@stop