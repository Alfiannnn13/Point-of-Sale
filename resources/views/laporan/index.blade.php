@extends('layouts.master')

@section('title')
    Laporan Pendapatan {{ tanggal_indonesia($tanggalAwal)}} s/d {{tanggal_indonesia($tanggalAkhir)}}
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('/AdminLTE-2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('breadcrumb')
    @parent
    <li class="active">Laporan</li>
@endsection

@section('content')
<div id="flash" dataflash="{{('')}}"></div>
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <button onclick="updatePeriode()" class="btn btn-info  btn-xl"><i class="fa fa-plus-circle"></i> Ubah Periode</button>
                <a href="{{ route('laporan.export_PDF', [$tanggalAwal, $tanggalAkhir]) }}" target="blank" class="btn btn-success btn-xl"><i class="fa fa-file-pdf-o"></i> Cetak PDF</a>
            </div>
            <div class="box-body table-responsive">
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Pembelian</th>
                            <th>Pengeluaran</th>
                            <th>Penjualan</th>
                            <th>Pendapatan</th>
                        </thead>
                    </table>
            </div>
        </div>
    </div>
</div>

@includeIf('laporan.form')
@endsection

@push('scripts')
<script src="{{ asset('/AdminLTE-2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'tanggal'},
                {data: 'pembelian'},
                {data: 'pengeluaran'},
                {data: 'penjualan'},
                {data: 'pendapatan'},
            ],
            bPaginate: false,
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });

    function updatePeriode(url) {
        $('#modal-form').modal('show');
        
    }

    
</script>
@endpush
