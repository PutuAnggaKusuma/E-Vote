@extends('admin.layout')

@section('title')
    <h1>Daftar Penduduk</h1>
@endsection

@section('content')
    <div class="container" >
		<div class="table-responsive" style="overflow-x: hidden;">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="d-flex flex-row-reverse mb-3 col-xs-6 w-100">
							<a href="#addModal" style="border-radius: 3px; gap: .5em;" class="btn btn-success d-flex align-items-center justify-content-center" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add</span></a>					
						</div>
					</div>
				</div>
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
                                    <a href="#editModal-{{$penduduk->id}}" class="edit" data-toggle="modal"><i class="material-icons text-warning" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <a href="#deleteModal-{{$penduduk->id}}" class="delete" data-toggle="modal"><i class="material-icons text-danger" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                </td>
                            </tr>
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>        
    </div>
	<!-- Add Modal HTML -->
	<div id="addModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="POST" action="{{route('penduduk.store')}}" accept-charset="UTF-8">
                    @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add Penduduk</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
                        <div class="form-group">
                            <label>Nama</label>
                            <input id="nama" name="nama" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input id="tanggal_lahir" name="tanggal_lahir" type="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nomor Induk Keluarga</label>
                            <input id="KTP" name="KTP" type="number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nomor Kartu Keluarga</label>
                            <input id="KK" name="KK" type="number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input list="jenis_kelamin" id="" name="jenis_kelamin" class="form-control" required>
                            <datalist id="jenis_kelamin">
                                <option value="1">Pria</option>
                                <option value="2">Wanita</option>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <input id="" list="agama" name="agama" class="form-control" required>
                            <datalist id="agama">
                                <option value="1">Buddha</option>
                                <option value="2">Hindu</option>
                                <option value="3">Islam</option>
                                <option value="4">Katolik</option>
                                <option value="5">Konghucu</option>
                                <option value="6">Kristen</option>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telp</label>
                            <input id="no_telp" name="no_telp" type="number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="banjar_id" class="control-label">Banjar</label>
                            <input id="" list="banjar_id" class="form-control" name="banjar_id" value="{{$banjar->nama}}" disabled>
                        </div>
                    </div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="submit" class="btn btn-success">Add</button>
					</div>
				</form>
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
	    <!-- Edit Modal HTML -->
        <div id="editModal-{{$penduduk->id}}" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{route('penduduk.update', $penduduk->id)}}" accept-charset="UTF-8">
                        @csrf
                        <div class="modal-header">						
                            <h4 class="modal-title">Update Penduduk</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <div class="form-group">
                                <label>Nama</label>
                                <input id="nama" name="nama" type="text" class="form-control" value="{{$penduduk->nama}}" required>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input id="tanggal_lahir" name="tanggal_lahir" type="date" class="form-control" value="{{$penduduk->tanggal_lahir}}" required>
                            </div>
                            <div class="form-group">
                                <label>Nomor Induk Keluarga</label>
                                <input id="KTP" name="KTP" type="number" class="form-control" value="{{$penduduk->KTP}}">
                            </div>
                            <div class="form-group">
                                <label>Nomor Kartu Keluarga</label>
                                <input id="KK" name="KK" type="number" class="form-control" value="{{$penduduk->KK}}" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input list="jenis_kelamin" id="" name="jenis_kelamin" type="text" class="form-control" value="{{$penduduk->jenis_kelamin}}" required>
                                <datalist id="jenis_kelamin">
                                    <option value="1">Pria</option>
                                    <option value="2">Wanita</option>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label>Agama</label>
                                <input id="" list="agama" name="agama" type="text" class="form-control" value="{{$penduduk->agama}}" required>
                                <datalist id="agama">
                                    <option value="1">Buddha</option>
                                    <option value="2">Hindu</option>
                                    <option value="3">Islam</option>
                                    <option value="4">Katolik</option>
                                    <option value="5">Konghucu</option>
                                    <option value="6">Kristen</option>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label>Nomor Telp</label>
                                <input id="no_telp" name="no_telp" type="number" class="form-control" value="{{$penduduk->no_telp}}" required>
                            </div>
                            <div class="form-group">
                                <label for="banjar_id" class="control-label">Banjar</label>
                                <input id="" list="banjar_id" class="form-control" name="banjar_id" value="{{$banjar->nama}}" disabled>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <button type="submit" class="btn btn-success">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Delete Modal HTML -->
        <div id="deleteModal-{{$penduduk->id}}" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{route('penduduk.destroy', $penduduk->id)}}">
                        @csrf
                        <div class="modal-header">						
                            <h4 class="modal-title">Delete Penduduk</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <p>Are you sure you want to delete {{$penduduk->nama}}'s data?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @endforeach
@endsection