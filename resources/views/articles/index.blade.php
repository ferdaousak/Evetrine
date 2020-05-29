@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
    <a href="{{route('articles.create')}}" class="btn btn-success">Add article</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Articles
        </div>
        <div class="card-body">
            @if($articles->count()>0)
            <table class="table">
                <thead>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>
                                {{$article->title}}
                            </td>
                            <td>
                                {{$article->description}}
                            </td>
                            <td>
                            <a href="{{route('categories.edit',$article->category->id)}}">
                                {{$article->category->name}}
                            </a>
                            </td>
                            <td>
                            <a href="{{route('articles.edit',$article->id)}}" class="btn btn-info btn-sm">
                                    Edit
                            </a>
                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{$article->id}})">
                                Delete
                            </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h3 class="text-center">No Articles Yet</h3>
            @endif
  <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <form action="" method="POST" id="deleteArticleForm">
                    @csrf
                    @method('DELETE')

                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <p class="text-center text-bold">
                            Are you sure you want to delete this article?
                        </p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back</button>
                        <button type="submit" class="btn btn-danger">Yes, delete</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function handleDelete(id)
        {
            var form = document.getElementById('deleteArticleForm');
            form.action ='/articles/'+id ;
            $('#deleteModal').modal('show')

        }
    </script>
@endsection
