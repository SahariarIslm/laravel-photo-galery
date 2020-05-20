@extends('layouts.app')
@section('content')
	@if(count($albums)>0)
		<?php 
			$colcount = count($albums);
			$i = 1;
		?>
		<style type="text/css">
			.thumbnail{width: 360px;height: 240px;}
		</style>
		<div id="albums">
			<div class="grid-x text-center">
				@foreach($albums as $album)
				@if($i==$colcount)
				<div class="cell large-4 end">
					<a href="{{ route('show',['album' => $album->id]) }}">
						<img class="thumbnail" src="storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
					</a>
					<br>
					<h4>{{$album->name}}</h4>
					@else
					<div class="cell large-4 columns">
						<a href="{{ route('show',['album' => $album->id]) }}">
							<img class="thumbnail" src="storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
						</a>
						<br>
						<h4>{{$album->name}} </h4>
						@endif
						@if($i % 3 == 0)
					</div>
				</div>
				<div class="grid-x text-center">
					@else
				</div>
					@endif
				<?php $i++; ?>
			@endforeach
			</div>
		</div>
		@else
		<p>No Albums Available To Display </p>
	@endif
@endsection





