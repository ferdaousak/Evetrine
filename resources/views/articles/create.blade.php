@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{isset($article) ? 'Edit Article' : 'Create Article'}}
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                        <li class="list-group-item text-danger">
                            {{$error}}
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form action="{{isset($article) ? route('articles.update',$article->id) : route('articles.store')}}" method="POST">
                @csrf
                @if(isset($article))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                <input type="text" id="title" class="form-control" name="title" value="{{isset($article) ? $article->title : ""}}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                <textarea  id="description" class="form-control" name="description" cols="5" rows="5" >{{isset($article) ? $article->description : ""}}
                </textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                @if(isset($article))
                                @if($category->id == $article->category_id)
                                selected
                                @endif
                                @endif
                            >
                        {{$category->name}}
                    </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        {{isset($article) ? 'Edit article' : 'Add article' }}
                    </button>

                </div>
            </form>
        </div>
    </div>

@endsection
