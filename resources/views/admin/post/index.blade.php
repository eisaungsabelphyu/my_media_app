@extends('admin.layouts.app')
@section('content')
    <div class="col-4">
        @if (session('createSuccess'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('createSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin#postCreate') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="postTitle">Post title</label>
                        <input type="text" class="form-control @error('postTitle') is-invalid @enderror" name="postTitle"
                            value="{{ old('postTitle') }}" id="postTitle">
                        @error('postTitle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea cols="30" rows="10" class="form-control @error('description') is-invalid @enderror"
                            name="description" id="description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="postCategory">Post Category</label>
                        <select class="form-control" id="postCategory" name="postCategory">
                            <option value="">Choose category</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                        @error('postCategory')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="postImage">Image</label>
                        <input type="file" class="form-control" id="postImage" name="postImage">
                        @error('postImage')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>

                </form>
            </div>
        </div>
    </div>
    <div class="col-8">
        @if (session('updateSuccess'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('updateSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Post List</h3>

                <div class="card-tools">
                    <form>
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="searchKey" value="{{ request('searchKey') }}"
                                class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Post Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>image</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr class="tr-shadow">
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td style="white-space:pre; word-wrap:break-word;">{{ $post->description }}</td>
                                <td>{{ $post->category_title }}</td>
                                <td>
                                    @if ($post->image == null)
                                        <img src="{{ asset('image/img-not-found.png') }}" class="img-thumbnail"
                                            style="width:100px; heigth:100px;">
                                    @else
                                        <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail"
                                            style="width:100px; heigth:100px;">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin#postEdit', $post->id) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('admin#postDelete', $post->id) }}">
                                        <button class="btn btn-sm bg-danger text-white"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $posts->appends(request()->query())->links() }}
                </div>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
