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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Export
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
            <ul class="nav nav-tabs">
               <li class="nav-item"><a class="nav-link" href="#csv" data-toggle="tab">CSV</a></li>
               <li class="nav-item"><a class="nav-link" href="#b" data-toggle="tab">baaaaa</a></li>
            </ul>
            <div class="tab-content">
               <!--Tab One-->
               <div class="tab-pane active" id="csv">
                  <br />
                  <form method='post' action="{{action('bookController@export')}}">
                     {{ csrf_field() }}
                     <div class="row">
                        <div class="form-group col-sm-4">
                           <input type="submit" name="exportcsv" value='Export All' class="btn btn-default btn-outline-success align-middle"/>
                        </div>
                        <div class="form-group col-sm-4">
                           <input type="submit" name="authorsCsv" value='Authors' class="btn btn-default btn-outline-success align-middle"/>
                        </div>
                     </div>
                  </form>
               </div>
               <!--Tab two-->
               <div class="tab-pane" id="b">
               <br />
                  <form method='post' action="{{action('bookController@exportxml')}}">
                     {{ csrf_field() }}
                     <div class="row">
                        <div class="form-group col-sm-4">
                           <input type="submit" name="exportxml" value='Export All' class="btn btn-default btn-outline-success align-middle"/>
                        </div>
                        <div class="form-group col-sm-4">
                           <input type="submit" name="authorsCsv" value='Authors' class="btn btn-default btn-outline-success align-middle"/>
                        </div>
                     </div>
                  </form>
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
