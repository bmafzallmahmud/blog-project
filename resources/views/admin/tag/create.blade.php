@extends('layouts.backEnd.master')

@section('title','Tag')

@push('css')

@endpush

@section('content')

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Add New Tag
                            </h2>

                        </div>
                        <div class="body">
                            <form method="post" action="{{ route('admin.tag.store')}}">
                                @csrf
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="name" class="form-control" name="name" >
                                        <label class="form-label">Add Tag</label>
                                    </div>
                                </div>
                                <a type="button" class="btn btn-danger m-t-15 waves-effect" href="{{route('admin.tag.index')}}">BACK</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection


@push('js')
    <script src="{{ asset('backEnd') }}/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{ asset('backEnd') }}/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="{{ asset('backEnd') }}/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="{{ asset('backEnd') }}/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="{{ asset('backEnd') }}/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="{{ asset('backEnd') }}/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="{{ asset('backEnd') }}/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="{{ asset('backEnd') }}/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="{{ asset('backEnd') }}/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script src="{{ asset('backEnd') }}/js/pages/tables/jquery-datatable.js"></script>
@endpush
