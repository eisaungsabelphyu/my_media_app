@extends('admin.layouts.app')
@section('content')
    <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Trend Post Page</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Post Title</th>
                      <th>Image</th>
                      <th>View Count</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($trendPost as $post)
                        <tr>
                            <td>{{ $post->post_id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                               @if ($post->image == null)
                                     <img src="{{asset('image/img-not-found.png')}}" class="img-thumbnail" width="100px">
                               @else
                                    <img src="{{asset('storage/'.$post->image)}}" class="img-thumbnail" width="100px">
                               @endif
                            </td>
                            <td><i class="fa-solid fa-eye"></i> {{$post->post_count}}</td>
                            <td>
                                <a href="{{route('admin#trendPostDetail',$post->post_id)}}">
                                    <button class="btn btn-sm bg-dark text-white"><i class="fa-solid fa-info"></i></button>
                                </a>

                            </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>
               <div class="mt-3">
                    {{ $trendPost->links() }}
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
@endsection
