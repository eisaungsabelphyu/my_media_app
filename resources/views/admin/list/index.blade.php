@extends('admin.layouts.app')
@section('content')
    <div class="col-12">
        <div class="offset-9 col-3">
            @if (Session::has('deleteSuccess'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{Session::get('deleteSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Admin List Page</h3>

                <div class="card-tools">
                  <form action="{{ route('admin#list') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="key" value="{{request('key')}}" class="form-control float-right" placeholder="Search">

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
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Gender</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                      <td>{{ $user['id'] }}</td>
                      <td>{{ $user['name'] }}</td>
                      <td>{{ $user['email'] }}</td>
                      <td>{{ $user['phone'] }}</td>
                      <td>{{ $user['address'] }}</td>
                      <td>{{ $user['gender'] }}</td>
                      <td>
                        @if (Auth::user()->id != $user['id'])
                            <a href="{{ route('admin#accountDelete',$user['id']) }}">
                                <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                            </a>
                        @endif
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
