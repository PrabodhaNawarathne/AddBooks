@extends('welcome')

@section('content')

<div class="row">
    <div class="col-md-6 offset-3">
        <br />
        <h3>Edit Author</h3>
        <br />
        <form method="post" action="{{action('bookController@update', $id)}}">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PATCH"/>
            <div class="form-group">
                <input type="text" name="title" class="form-control" value="{{$books['title']}}" placeholder="Enter Title" readonly/>
            </div>
            <div class="form-group">
                <input type="text" name="author" class="form-control" value="{{$books['author']}}" placeholder="Enter Author"/>
                @error('author')
                    <div class="alert alert-danger">Author cannot be null !!</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary float-right" value="Update"/>

                <input type="submit" class="btn btn-primary float-left" value="Cancel" action="{{action('bookController@index', $id)}}"/>

            </div>
        </form>
    </div>
</div>

@endsection
