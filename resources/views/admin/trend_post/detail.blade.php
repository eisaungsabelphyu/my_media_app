@extends('admin.layouts.app')
@section('content')
    <div class="col-6 offset-3 mt-5">
      <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
        <div class="card-header">
            <div class="text-center">
                <img class="rounded-shadow" width="400px"
                @if($post['image'] == null) src="{{ asset('image/img-not-found.png')}}"
                @else src="{{asset('storage/'.$post['image'])}}" @endif>

            </div>
        </div>
        <div class="card-body">
            <h3 class="text-center">{{ $post['title']}}</h3>
            <p class="text-start">{{ $post['description']}}</p>
        </div>
    </div>
@endsection
