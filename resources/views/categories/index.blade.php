@extends('layouts.app')

@section('content')
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session() -> get('error') }}
        </div>
    @endif
<div class="clearfix">
        <a href="{{ route('categories.create') }}" class="btn btn-success" style="margin-bottom: 10px">
            Add Category</a>
</div>

<div class="card cad-default">
    <div class="card-header">All Categories</div>
    <div>
        <table class="card-body">
            <table class="table">
        
        @foreach($categories as $category)
            <tr>
                <td>
                    {{ $category->name}}
                </td>

                <td>
               
             <form class="float-right ml-2" action="{{route('categories.destroy',$category->id)}}" method="POST">
             @csrf
             @method('DELETE')
             <button class="btn btn-outline-danger btn-sm">Delete
             <i class="fa fa-trash-o"></i>
             </button>
             </form>
               
                

             <a href="{{ route('categories.edit',$category->id) }}" style="color:#1e7e34" 
             class="btn btn-outline-success btn-sm float-right">
             Edit <i class='fa fa-edit'></i>
            </a>
             </td>

               
            </tr>
            
        @endforeach
</div>


@endsection