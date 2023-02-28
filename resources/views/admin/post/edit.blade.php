@extends('admin.layouts.app')
@section('content')
    <div class="col-4">
        @if (session('updateSuccess'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('updateSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin#postUpdate', $editPost->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="postTitle">Post title</label>
                        <input type="text" class="form-control @error('postTitle') is-invalid @enderror" name="postTitle"
                            value="{{ old('postTitle', $editPost->title) }}" id="postTitle">
                        @error('postTitle')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Description</label>
                        <textarea cols="30" rows="10" class="form-control @error('description') is-invalid @enderror"
                            name="description" id="description">{{ old('description', $editPost->description) }}</textarea>
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
                                <option value="{{ $item->id }}" @if ($editPost->category_id == $item->id) selected @endif>
                                    {{ $item->title }}</option>
                            @endforeach
                        </select>
                        @error('postCategory')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        @if ($editPost->image == null)
                            <img src="{{ asset('image/img-not-found.png') }}" class="img-thumbnail shadow-sm rounded mb-2"
                                width="100%">
                        @else
                            <img src="{{ asset('storage/' . $editPost->image) }}"
                                class="img-thumbnail shadow-sm rounded mb-2" width="100%">
                        @endif
                        <label class="form-label" for="postImage">Image</label>
                        <input type="file" class="form-control" id="postImage" name="postImage">
                        @error('postImage')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin#post') }}">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-7">
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
                <h3 class="card-title">Post Edit Page</h3>

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
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td class="col-3">{{ $item->title }}</td>
                                <td class="col-5 text-start">{{ $item->description }}</td>
                                <td>{{ $item->category_title }}</td>
                                <td>
                                    @if ($item->image == null)
                                        <img src="{{ asset('image/img-not-found.png') }}" class="img-thumbnail"
                                            style="width:100px; heigth:100px;">
                                    @else
                                        <img src="{{ asset('storage/' . $item->image) }}" class="img-thumbnail"
                                            style="width:100px; heigth:100px;">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin#postEdit', $item->id) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('admin#postDelete', $item->id) }}">
                                        <button class="btn btn-sm bg-danger text-white"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
