@extends('layouts.backEnd.master')

@section('title','edit Category')

@push('css')
@endpush

@section('content')

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                 Edit Category
             </h2>

         </div>
         <div class="body">
            <form method="post" enctype="multipart/form-data" action="{{ route('admin.category.update',$category->id)}}">
                @csrf
                @method('put')
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" id="name" class="form-control" name="name" value="{{ $category->name }}">
                        <label class="form-label">Add Tag</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="file" id="image" class="form-control" name="image" value="{{ $category->image }}">
                        <label class="form-label">Add Tag</label>
                    </div>
                </div>
                <a type="button" class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.category.index')}}">BACK</a>
                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
            </form>
        </div>
    </div>
</div>
</div>

@endsection


@push('js')

@endpush
