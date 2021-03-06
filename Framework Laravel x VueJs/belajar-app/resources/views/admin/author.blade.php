@extends('layouts.admin')
@section('header', 'Author')

@section('css')
  <!-- Data Table -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')

<div id="controller">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <a href="#" @click="addData()" class="btn btn-sm btn-primary pull-right">Create New Author</a>
                <!-- <a href="{{ url('authors/create') }}" class="btn btn-sm btn-primary pull-right">Create New Author</a> -->
                </div>
              <!-- /.card-header -->
                <div class="card-body p-3">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Name</th>
                                <th class="text-center align-middle">Email</th>
                                <th class="text-center align-middle">Phone Number</th>
                                <th class="text-center align-middle">Address</th>
                                <!-- <th class="text-center align-middle">Total Buku</th> -->
                                <th class="text-center align-middle">Created_at</th>
                                <th width="15%" class="text-center align-middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($authors as $key => $author)
                            <tr>
                            <td class="text-center align-middle">{{ $key+1 }}</td>
                                <td class="align-middle"> {{ $author->name }} </td>
                                <td class="align-middle"> {{ $author->email }} </td>
                                <td class="text-center align-middle"> {{ $author->phone_number }} </td>
                                <td class="align-middle"> {{ $author->address }} </td>
                                <!-- <td class="text-center align-middle"> {{ count($author->books) }} </td> -->
                                <td class="text-center align-middle">{{ dateFormat($author->created_at) }}</td>
                                <td class="text-center align-middle">
                                <!-- <a href="{{ url('authors/'.$author->id.'/edit') }}" class="btn btn-warning btn-sm mb-2"> Edit </a>
                                <form action="{{ url('authors', ['id' => $author->id]) }}" method="post">
                                    <input class="btn btn-danger btn-sm" type="submit" value="Delete" onclick="
                                    return confirm('Are You sure wanna delete this?')">
                                    @method('delete')
                                    @csrf
                                </form> -->
                                    <a href="#" @click="editData({{ $author }})" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="#" @click="deleteData({{ $author->id }})" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                <!-- /.card-body -->
              </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" :action="actionUrl" autocomplete="off">
                    <div class="modal-header">
                        <h4 class="modal-title">author</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" :value="data.name" required="">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" :value="data.email" required="">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" :value="data.phone_number" required="">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" :value="data.address" required="">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>

@endsection

@section('js')

    <!-- Data Table -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.j') }}s"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
   
    <!-- CRUD Vue js -->
    <script type="text/javascript">
        var controller = new Vue({
            el: '#controller',
            data: {
                data: {},
                actionUrl : '{{ url('authors') }}', 
                editStatus : false
            },
            mounted: function() {

            },
            methods: {
                addData() {
                    this.data = {};
                    this.actionUrl = '{{ url('authors') }}';
                    this.editStatus = false;
                    $('#modal-default ').modal();
                }, 
                editData(data){
                    this.data = data;
                    this.actionUrl = '{{ url('authors') }}'+'/'+data.id;
                    this.editStatus = true;
                    $('#modal-default ').modal();
                },
                deleteData(id){
                    this.actionUrl = '{{ url('authors') }}'+'/'+id;
                    
                    if (confirm("Are You sure wanna delete this?")) {
                        axios.post('{{ url('authors') }}'+'/'+id, {_method: 'DELETE'}).then(response =>{
                            location.reload();
                        });
                        // axios.delete(this.actionURL).then(response => {
                        //     console.log(response);
                        // });

                        // axios.delete('{{ url('authors') }}'+'/'+id)
                        // .then(response => {
                        //     location.reload();
                        //     console.log();
                        // })
                        // .catch(function (error) {
                        //     console.log(error.response)
                        // })
                    }
                }
            }
        });
    </script>

    <!-- Data Table -->
    <script type="text/javascript">
        $(function () {
            $("#datatable").DataTable({
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection