@extends('admin.layouts.app')
@section('content')
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin#categoryUpdate', $editCategory->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="categoryId" value="{{ $editCategory->id }}">
                    <div class="mb-3">
                        <label class="form-label" for="categoryName">Category Name</label>
                        <input type="text" class="form-control @error('categoryName') is-invalid @enderror"
                            name="categoryName" value="{{ old('categoryName', $editCategory->title) }}" id="categoryName">
                        @error('categoryName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">

                        <label class="form-label" for="description">Description</label>
                        <textarea cols="30" rows="10" class="form-control @error('description') is-invalid @enderror"
                            name="description" id="description">{{ old('description', $editCategory->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin#categoryCreate') }}">
                        <button type="button" class="btn btn-dark">Create</button>
                    </a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-7">
        @if (session('updateSuccess'))
            <div class="col-4 offset-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category Edit Page</h3>

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
                            <th>Category Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category['id'] }}</td>
                                <td class="col-3">{{ $category['title'] }}</td>
                                <td class="col-5 text-start">{{ $category['description'] }}</td>
                                <td>
                                    <a href="{{ route('admin#categoryEdit', $category['id']) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('admin#categoryDelete', $category['id']) }}">
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
