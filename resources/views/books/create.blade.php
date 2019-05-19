<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Laravel 5.5 CRUD Tutorial With Example From Scratch </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
      <h2>Create A Book</h2><br  />
      <div>
        <form method="post" action="{{url('books')}}">
        {{csrf_field()}}
            <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="name">Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <div class="alert alert-danger">Title cannot be null !!</div>
                @enderror
            </div>
            </div>
            <div class="row">
            <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                <label for="price">Author</label>
                <input type="text" name="author" class="form-control @error('author') is-invalid @enderror">
                @error('title')
                    <div class="alert alert-danger">Author cannot be null !!</div>
                @enderror
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-primary float-right" style="margin-left:38px">Add Book</button>
            </div>
            </div>
        </form>
        </div>

  </body>
</html>
