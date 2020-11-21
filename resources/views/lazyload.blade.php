@extends('layout.app')

@section('content')
    <div class="row justify-content-center">
        <div class="card ">
            <div class="card-header">{{$title}}</div>    
            <div class="card-body">
                <table cellpadding="0" cellspacing="0" class="table table-responsive table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>Book Name</th>
                            <th>Author</th>
                        </tr>
                        @foreach ($books as $book )
                            <tr>
                                <td>{{$book->book_id}}</td>
                                <td>{{$book->book_name}}</td>
                                <td>{{$book->author->author_name}}</td>
                            </tr>
                        @endforeach
                    </thead>
                </table>
            </div>
        </div>    
    </div>
@endsection