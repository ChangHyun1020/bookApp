@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>포럼 글 목록</h1>
		<hr>
		<ul>
			@forelse($articles as $article)
				<li>
					{{ $article->title }}
					<small>
						by {{ $article->user->name }}
					</small>
				</li>
			@empty
				<p>Not find</p>
			@endforelse
		</ul>
	</div>

	@if($articles->count())
		<div class="text-center">
			{!! $articles->render() !!}
		</div>
	@endif

@endsection