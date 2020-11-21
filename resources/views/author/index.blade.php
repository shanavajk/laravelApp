@extends('layout.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header">Author</div>    
                <div class="card-body"> 
                    @if(isset($message))
                        <div class="alert alert-success" role="alert">
                        {{$message}}
                        </div>
                    @endif
        
                    @if($errors->has('author_name'))
                        <div class="alert alert-danger" role="alert">
                            Author Name is invalid ...!
                        </div>
                    @endif
                    {!! Form::open(['action' => 'AuthorController@create', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="modal-body">                                     
                            {{Form::text('author_name', '', ['id' => 'author_name', 'class' => 'form-control', 'placeholder' => 'Author Name', 'required' => 'required'])}}
                            <br/>
                            <div class="text-right">
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <br/>
                    {!! Form::close() !!}
                    <br/>
                    
                    <div class="table-responsive ">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table  table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Author Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sl =0 @endphp
                                @foreach ($authors as $author )
                                    <tr>
                                        <td>{{$sl+=1}}</td>
                                        <td>{{$author->author_name}}</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" onclick="editAuthor({{$author->author_id}}, '{{$author->author_name}}')" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" class="btn btn-sm btn-info"> Edit</a>
                                           
                                            <a href="javascript:void(0)" onclick="deleteAuthor({{$author->author_id}}, '{{$author->author_name}}')" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" class="btn btn-sm btn-info"> Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            @if($authors instanceof \Illuminate\Pagination\LengthAwarePaginator )
                                {{$authors->links()}}
                            @endif
                        </div>
                    </div>
                </div>
            </div> 
        </div>  
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal
    " aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Update Author</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action' => 'AuthorController@update', 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return validate()']) !!}
                    <div class="modal-body">
                        {{Form::hidden('author_id', '', array('id' => 'author_id'))}}                    
                        {{Form::text('author_name', '', ['id' => 'edit_author_name', 'class' => 'form-control', 'placeholder' => 'Author Name', 'required' => 'required'])}}
                        <br/>
                        <div class="text-right">
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <br/>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal
    " aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">Delete Author</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['action' => 'AuthorController@delete', 'method' => 'DELETE', 'enctype' => 'multipart/form-data']) !!}
                    <div class="modal-body">
                        {{Form::hidden('author_id', '', array('id' => 'delete_author_id'))}}
                        Are you sure to delete author <span class="text-info author_name"></span> ?
                        <br/>
                        <div class="text-right">
                            <button type="submit" class="btn btn-sm btn-success">Delete</button>
                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <br/>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var original_author_name = "";
        function editAuthor(id, name)
        {   
            original_author_name = name;
            $('#author_id').val(id);
            $('#edit_author_name').val(name);
        }
        function validate()
        {
            if(original_author_name == $('#edit_author_name').val())
            {           
                return false;
            }
            return true;
        }
    
        function deleteAuthor(id, name)
        {
            $('#delete_author_id').val(id);
            $(".author_name").html(name);
        }
    </script>
@endsection