@extends('layouts.app')

@section('stylesheets')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

    <div class="card card-default">
        <div class="card-header"> {{ isset($post) ? "Update Post" : "Add a new Post" }}</div>

        <div class="card-body">
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($post))
             @method('PUT')
        @endif
        <div class="form-group">
                <label for="post title"> Post title </label>
                <input type="text" name="title" class="@error('title') is-invalid @enderror form-control"
                 placeholder="Add a new title"  value="{{ isset($post) ? $post->title : "" }}">

           </div> 
           
           @error('title')
                    <div class="alert alert-danger">
                    {{ $message }}
                    </div>
            @enderror

           <div class="form-group">
                <label for="post description"> Post Description </label>
               
                 <textarea type="text" name="description" class="@error('description') is-invalid @enderror form-control"
                 placeholder="Add a new description" rows="2">{{ isset($post) ? $post->description : "" }}</textarea>
           </div>  
           
           @error('description')
                    <div class="alert alert-danger">
                    {{ $message }}
                    </div>
            @enderror


           <div class="form-group">
                <label for="post content"> Post Content </label>

                {{-- <textarea class="form-control" rows="3" name="content" placeholder="Add a content"></textarea> --}}
                    <input id="x" type="hidden" name="content" value="{{ isset($post) ? $post->content : "" }}" 
                    value="{{ isset($post) ? $post->content : "" }}">
                    <trix-editor input="x"></trix-editor>
           </div>
           @error('content')
                    <div class="alert alert-danger">
                    {{ $message }}
                    </div>
            @enderror 

            @if (isset($post))
                  <div class="form-group">
                    <img src="{{asset('storage/' . $post->image)}}" style="width: 100%" />
                  </div>
                @endif

           <div class="form-group">
                <label for="post image"> Post Image </label>
            <p> <input type="file" name="image" 
            class="@error('image') is-invalid @enderror form-control"></p> 
           </div> 
         
           @error('image')
                    <div class="alert alert-danger">
                    {{ $message }}
                    </div>
            @enderror  

            <div class="form-group">
            <label for="selectCategory">Select a category</label>
            <select name="categoryID" class="form-control" id="selectCategory">
                    @foreach ($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
           </select>
           </div>
          
            @if(!$tags->count() <= 0   )
            <div class="form-group">
              <label for="selectTag">Select a tag</label>     
              <select name="tags[]" class="custom-select tags" id="selectTag" multiple>
                  @foreach ($tags as $tag)
                  <option value="{{$tag->id}}" 
                          @if (isset($post) && $post->hasTag($tag->id))
                            selected
                          @endif
                         >
                          {{$tag->name}}
                        </option>
                  @endforeach 
              </select>
            </div>
            @endif
           <div class="form-group">
           <button type ="submit" class="btn btn-success">{{ isset($post) ? "Update" : "Add" }}</a>  
           </div>
        </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script>
      $(document).ready(function() {
        $('.tags').select2();
      });
    </script>
@endsection