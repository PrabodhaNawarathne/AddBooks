@extends('welcome')

@section('content')
      <div class="row">
      <div class="col-md-6 offset-3">

      <h2 class="text" style="margin-top:3%">Create A Book</h2><br  />
        <form method="post" action="{{url('books')}}">
        {{csrf_field()}}
            <div class="form-group">
                <input type="text" placeholder="Title" name="title" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <div class="alert alert-danger">Title cannot be null !!</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" placeholder="Author" name="author" class="form-control @error('author') is-invalid @enderror">
                @error('title')
                    <div class="alert alert-danger">Author cannot be null !!</div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right" style="margin-left:38px">Add Book</button>
                <a  align="left" class="btn btn-primary float-right" style="margin-left:1%" href="{{route('books.index')}}">Cancel</a>

            </div>
        </form>
        </div>
    </div>
@endsection
