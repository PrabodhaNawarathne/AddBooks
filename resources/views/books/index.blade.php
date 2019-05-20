@extends('welcome')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div style="height:30%">
            <h3 align="center">Your Favourite Books</h3>
            <!-- @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div><br />
            @endif -->
        </div>
        <div>
            <div>
                <a  align="left" class="btn btn-primary float-right" style="margin-left:1%" href="{{route('books.create')}}">New Book</a>

                <a href="{{route('export.csv')}}" class="btn btn-primary">CSV Export</a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Excel Export
                </button>
            </div>
            <table id="booksTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="th-sm">Title</th>
                    <th class="th-sm">Author</th>
                    <th class="th-sm">Edit</th>
                    <th class="th-sm">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $row)
                <tr>
                    <td>{{$row['title']}}</td>
                    <td>{{$row['author']}}</td>
                    <td><a class="btn" href="{{action('bookController@edit', $row['id'])}}"><i class="fa fa-edit"></i></a></td>
                    <td>
                        <form method="post" class="delete_form"  action="{{action('bookController@destroy', $row['id'])}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" class="btn"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
                <!-- <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Author</th>
                </tr> -->
            </table>
        </div>
        </div>
    </div>

    <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Export Options</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-4">
                <a href="{{route('export')}}" class="btn btn-primary align-middle"><i class="fas fa-download fa-3x align-middle"></i></a>
                <p class="h6 align-middle">Export All</p>
                </div>
                <div class="col-sm-4">
                <a href="{{route('export')}}" class="btn btn-primary align-middle"><i class="fas fa-download fa-3x align-middle"></i></a>
                <p class="h6 align-middle">Export Authors</p>
                </div>
                <div class="col-sm-4">
                <a href="{{route('export')}}" class="btn btn-primary align-middle"><i class="fas fa-download fa-3x align-middle"></i></a>
                <p class="h6 align-middle">Export Titles</p>
                </div>
            </div>
        </div>

      </div>
    </div>
  </div>


</div>


<script>
$(document).ready(function(){
    $('.delete_form').on('submit', function(){
        if(confirm("Delete the book?")){
            return true;
        }else{
            return false;
        }
    });
});



    $(document).ready(function () {
$('#booksTable').DataTable();
});
</script>
@endSection
