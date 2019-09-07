@extends('layouts.backEnd.master')

@section('title','Authors')

@push('css')
<link href="{{ asset('backEnd') }}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

@endpush

@section('content')

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
          ALL AUTHORS
          <span class="badge bg-blue">{{ $authors->count() }}</span>
        </h2>
      </div>
     <div class="body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Posts</th>
              <th>Comments</th>
              <th>Favorite Posts</th>
              <th>Created at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Posts</th>
              <th>Comments</th>
              <th>Favorite Posts</th>
              <th>Created at</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
           @foreach($authors as $key=>$author)
            <tr>
              <td>{{ $key +1 }}</td>
              <td>{{ $author->name}}</td>
              <td>{{ $author->posts_count }}</td>
              <td>{{ $author->comments_count }}</td>
              <td>{{ $author->favorite_posts_count }}</td>
              <td>{{ $author->created_at}}</td>
              
              <td class="text-center">
                <button class="btn btn-danger waves-effect " type="button" onclick="deleteAuthor({{$author->id}})">                            
                  <i class="material-icons">delete </i>
                  <span>delete</span>
                </button>
                <form method="post" id="delete-form-{{$author->id}}" action="{{ route('admin.author.destroy',$author->id)}}" style="display: none;">
                 @csrf 
                 @method('DELETE')
               </form>
             </td>

           </tr>
           @endforeach


         </tbody>
       </table>
     </div>
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
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

<script type="text/javascript">
  function deleteAuthor(id){
    const swalWithBootstrapButtons = swal.mixin({
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      buttonsStyling: false,
    })

    swalWithBootstrapButtons({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
        event.preventDefault();
        document.getElementById('delete-form-'+id).submit();
      } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                        ) {
        swalWithBootstrapButtons(
          'Cancelled',
          'Your imaginary file is safe :)',
          'error'
          )
      }
    })
  }
</script>

@endpush
