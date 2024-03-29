@extends('layouts.backEnd.master')

@section('title','Post')

@push('css')
<link href="{{ asset('backEnd') }}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

@endpush

@section('content')
<div class="block-header">
  <a class="btn btn-primary waves-effect" href="{{ route('admin.post.create') }}">
    <i class="material-icons">add</i>
    <span>Add New Tag</span>
  </a>
</div>
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">

      <div class="header">
        <h2>
          ALL POSTS
          <span class="badge bg-blue">{{ $posts->count() }}</span>
        </h2>
      </div>
     <div class="body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
          <thead>
            <tr>
              <th>Id</th>
              <th>Title</th>
              <th>Auther</th>
              <th><i class="material-icons">visibility<i/></th>
              <th>is Approved</th>
              <th>Status</th>
              <th>Created at</th>
              <th>Updated at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Title</th>
              <th>Auther</th>
              <th><i class="material-icons">visibility<i/></th>
              <th>is Approved</th>
              <th>Status</th>
              <th>Created at</th>
              <th>Updated at</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
           @foreach($posts as $key=>$post)
            <tr>
              <td>{{ $key +1 }}</td>
              <td>{{ str_limit($post->title,10)}}</td>
              <td>{{ $post->user->name}}</td>
              <td>{{ $post->view_count}}</td>
              <td>
                  @if ($post->is_approved == true)
                    <span class="badge bg-blue">Approved</span>
                  @else
                    <span class="badge bg-pink">Pending</span>
                  @endif
              </td>
              <td>
                  @if ($post->status == true)
                    <span class="badge bg-blue">published</span>
                  @else
                    <span class="badge bg-pink">In Active</span>
                  @endif
              </td>

              <td>{{ $post->created_at}}</td>
              <td>{{ $post->updated_at}}</td>
              <td class="text-center">
                @if($post->is_approved == false)
                    <button type="button" class="btn btn-success waves-effect" onclick="approvePost({{ $post->id }})">
                        <i class="material-icons">done</i>
                    </button>
                    <form method="post" action="{{ route('admin.post.approve',$post->id) }}" id="approval-form" style="display: none">
                        @csrf
                        @method('PUT')
                    </form>
                @endif
                <a href="{{ route('admin.post.show', $post->id) }}" class="btn btn-info waves-effect">                            
                  <i class="material-icons">visibility 
                  </i>
                  <span>show</span>
                </a>
                <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-info waves-effect">                            
                  <i class="material-icons">edit 
                  </i>
                  <span>edit</span>
                </a>
                <button class="btn btn-danger waves-effect " type="button" onclick="deletePost({{$post->id}})">                            
                  <i class="material-icons">delete </i>
                  <span>delete</span>
                </button>
                <form method="post" id="delete-form-{{$post->id}}" action="{{ route('admin.post.destroy',$post->id)}}" style="display: none;">
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
  function deletePost(id){
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

  function approvePost(id){
    const swalWithBootstrapButtons = swal.mixin({
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      buttonsStyling: false,
    })

    swalWithBootstrapButtons({
      title: 'Are you sure?',
      text: "You wont to  approve this post!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, approve it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
        event.preventDefault();
        document.getElementById('approval-form').submit();
      } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                        ) {
        swalWithBootstrapButtons(
          'Cancelled',
          'the post remine pending:)',
          'info'
          )
      }
    })
  }
</script>

@endpush
