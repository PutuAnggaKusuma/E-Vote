@extends('admin.layout')

@section('title')
    <h1>Daftar Pemilih</h1>
@endsection

@section('content')
    <div class="container">
		<div class="table-responsive" style="overflow-x: hidden;">
			<div class="table-wrapper">
				<table id="dataTable" class="table table-striped table-hover">
					<thead>
						<tr>
							<th>NIK</th>
							<th>Nama</th>
							<th>Banjar</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($penduduks as $penduduk)
                            <tr>
                                <td>{{ $penduduk->KK }}</td>
                                <td>{{ $penduduk->nama }}</td>
                                <td>{{ $penduduk->banjar->nama }}</td>
                                <td>
                                    <a href="#viewModal-{{$penduduk->id}}" class="view" data-toggle="modal"><i class="material-icons text-primary" data-toggle="tooltip" title="View">&#xe417;</i></a>
                                </td>
                            </tr>
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>        
    </div>

    @foreach ($penduduks as $penduduk)
	    <!-- View Modal HTML -->
        <div id="viewModal-{{$penduduk->id}}" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">						
                            <h4 class="modal-title">Detail Penduduk</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">		
                            <div class="form-group">
                                <label>Nama</label>
                                <input id="nama" name="nama" type="text" class="form-control" value="{{$penduduk->nama}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input id="tanggal_lahir" name="tanggal_lahir" type="text" class="form-control" value="{{$penduduk->tanggal_lahir}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nomor Induk Keluarga</label>
                                <input id="KTP" name="KTP" type="text" class="form-control" value="{{$penduduk->KTP}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nomor Kartu Keluarga</label>
                                <input id="KK" name="KK" type="text" class="form-control" value="{{$penduduk->KK}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input id="jenis_kelamin" name="jenis_kelamin" type="text" class="form-control" value="{{$penduduk->jenis_kelamin}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Agama</label>
                                <input id="agama" name="agama" type="text" class="form-control" value="{{$penduduk->agama}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nomor Telp</label>
                                <input id="no_telp" name="no_telp" type="text" class="form-control" value="{{$penduduk->no_telp}}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Banjar</label>
                                <input id="banjar" name="banjar" type="text" class="form-control" value="{{$penduduk->banjar->nama}}" disabled>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection