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
                <a  align="left" class="btn btn-primary" href="{{route('books.create')}}">New Book</a>
                <input type="text" class="data-search-text">
            </div>
            <table id="example" class="table table-striped table-bordered">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                @foreach ($books as $row)
                <tr>
                    <td>{{$row['title']}}</td>
                    <td>{{$row['author']}}</td>
                    <td><a class="btn btn-warning" href="{{action('bookController@edit', $row['id'])}}">Edit</a></td>
                    <td></td>
                </tr>
                @endforeach
                <!-- <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Author</th>
                </tr> -->
            </table>
        </div>
        </div>
    </div>
</div>
@endSection
