@extends('layouts.admin')
@section('header', 'Transaction')

@section('css')
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-lg-8">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Peminjaman Baru</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url('transactions') }}" method="post">
                    @csrf

                    <!-- <input type="hidden" name="_method" value="PUT" v-if="editStatus"> -->

                    <div class="form-group row mt-3">
                        <label class="col-md-3 ml-3 mr-0">Nama</label>
                        <select name="member_id" class="form-control col-md-8" id="">
                            @foreach($members as $member)
                            <option :selected="transaction.member_id == {{ $member->id }}" value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Date -->
                    <div class="form-group row">
                      <label class="mt-3 col-md-3">Date:</label>
                        <div class="input-group date col-md-4" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="date_start" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <div class="input-group date col-md-4" id="reservationdate1" data-target-input="nearest">
                            <input type="text" name="date_end" class="form-control datetimepicker-input" data-target="#reservationdate1"/>
                            <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label class="col-md-3 ml-3 mr-0">Book</label>
                        <select name="book_id" class="form-control col-md-8" id="">
                            @foreach($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" value="1" type="radio" name="status" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                          Sudah Dikembalikan
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" value="0" type="radio" name="status" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                          Belum Dikembalikan
                        </label>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card -->
@endsection


@section('js')
    <!-- CRUD Vue js -->
    <!-- <script type="text/javascript">
        var controller = new Vue({
            el: '#controller',
            data: {
                data: {},
                actionUrl : '{{ url('transactions') }}', 
                editStatus : false
            },
            mounted: function() {

            },
            methods: {
                addData() {
                    this.data = {};
                    this.actionUrl = '{{ url('transactions') }}';
                    this.editStatus = false;
                }, 
                editData(data){
                    this.data = data;
                    this.actionUrl = '{{ url('transactions') }}'+'/'+data.id;
                    this.editStatus = true;
                },
                deleteData(id){
                    this.actionUrl = '{{ url('transactions') }}'+'/'+id;
                    
                    if (confirm("Are You sure wanna delete this?")) {
                        axios.post('{{ url('transactions') }}'+'/'+id, {_method: 'DELETE'}).then(response =>{
                            location.reload();
                        });
                    }
                }
            }
        });
    </script> -->
    <script type="text/javascript">
           
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });
        //Date picker
        $('#reservationdate1').datetimepicker({
            format: 'L'
        });

    </script>  
@endsection