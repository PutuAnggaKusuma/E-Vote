@extends('admin.layout')

@section('title')
    <h1>Daftar Kandidat</h1>
@endsection

@section('content')
    <div class="container">
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
							<th>Nomor</th>
							<th>Nama Paslon</th>
							<th>Foto</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($kandidats as $kandidat)
                            <tr>
                                <td>{{ $kandidat->nomor_pasangan }}</td>
                                <td>{{ $kandidat->nama_kepala . ' & ' . $kandidat->nama_wakil_kepala }}</td>
                                <td><img style="max-width: 100px; max-height: 100px;" src="{{asset('storage/' . $kandidat->foto)}}" alt="Foto Kandidat"></td>
                                <td>
                                    <a href="#viewModal-{{$kandidat->id}}" class="view" data-toggle="modal"><i class="material-icons text-primary" data-toggle="tooltip" title="View">&#xe417;</i></a>
                                    <a href="#editModal-{{$kandidat->id}}" class="edit" data-toggle="modal"><i class="material-icons text-warning" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <a href="#deleteModal-{{$kandidat->id}}" class="delete" data-toggle="modal"><i class="material-icons text-danger" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
				<form method="POST" action="{{route('kandidat.store')}}" enctype="multipart/form-data">
                    @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add Kandidat</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
                        <div class="form-group">
                            <label class="form-label">Nomor Pasangan</label>
                            <input id="nomor_pasangan" name="nomor_pasangan" type="number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Kepala</label>
                            <input id="nama_kepala" name="nama_kepala" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Wakil Kepala</label>
                            <input id="nama_wakil_kepala" name="nama_wakil_kepala" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Foto</label>
                            <input id="foto" name="foto" type="file" class="form-control" accept="image/jpg, image/jpeg, image/png" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Visi</label>
							<textarea name="visi" id="visi" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Misi</label>
							<textarea name="misi" id="misi" class="form-control" rows="5" required></textarea>
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

    @foreach ($kandidats as $kandidat)

	    <!-- View Modal HTML -->
        <div id="viewModal-{{$kandidat->id}}" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form>
						<div class="modal-header">						
							<h4 class="modal-title">Detail Kandidat</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">					
							<div class="form-group">
								<img style="width: 100%; max-height: 200px; object-fit:fill;" src="{{asset('storage/' . $kandidat->foto)}}" alt="Foto Kandidat">
							</div>
							<div class="form-group">
								<label class="form-label">Nomor Pasangan</label>
								<input id="nomor_pasangan" name="nomor_pasangan" type="number" class="form-control" value="{{$kandidat->nomor_pasangan}}" readonly>
							</div>
							<div class="form-group">
								<label class="form-label">Nama Kepala</label>
								<input id="nama_kepala" name="nama_kepala" type="text" class="form-control" value="{{$kandidat->nama_kepala}}" readonly>
							</div>
							<div class="form-group">
								<label class="form-label">Nama Wakil Kepala</label>
								<input id="nama_wakil_kepala" name="nama_wakil_kepala" type="text" class="form-control" value="{{$kandidat->nama_wakil_kepala}}" readonly>
							</div>
							<div class="form-group">
								<label class="form-label">Visi</label>
								<textarea name="misi" id="misi" class="form-control" rows="5" readonly>{{$kandidat->visi}}</textarea>
							</div>
							<div class="form-group">
								<label class="form-label">Misi</label>
								<textarea name="misi" id="misi" class="form-control" rows="5" readonly>{{$kandidat->misi}}</textarea>
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
        <div id="editModal-{{$kandidat->id}}" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="POST" action="{{route('kandidat.update', $kandidat->id)}}" enctype="multipart/form-data">
						@csrf
						<div class="modal-header">						
							<h4 class="modal-title">Update Kandidat</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">					
							<div class="form-group">
								<label class="form-label">Nomor Pasangan</label>
								<input id="nomor_pasangan" name="nomor_pasangan" type="number" class="form-control" value="{{$kandidat->nomor_pasangan}}" required>
							</div>
							<div class="form-group">
								<label class="form-label">Nama Kepala</label>
								<input id="nama_kepala" name="nama_kepala" type="text" class="form-control" value="{{$kandidat->nama_kepala}}" required>
							</div>
							<div class="form-group">
								<label class="form-label">Nama Wakil Kepala</label>
								<input id="nama_wakil_kepala" name="nama_wakil_kepala" type="text" class="form-control" value="{{$kandidat->nama_wakil_kepala}}" required>
							</div>
							<div class="form-group">
								<label class="form-label">Foto</label>
								<input id="foto" name="foto" type="file" class="form-control" accept="image/jpg, image/jpeg, image/png" required>
							</div>
							<div class="form-group">
								<label class="form-label">Visi</label>
								<textarea name="visi" id="visi" class="form-control" rows="5" required>{{$kandidat->visi}}</textarea>
							</div>
							<div class="form-group">
								<label class="form-label">Misi</label>
								<textarea name="misi" id="misi" class="form-control" rows="5" required>{{$kandidat->misi}}</textarea>
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
        <div id="deleteModal-{{$kandidat->id}}" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{route('kandidat.destroy', $kandidat->id)}}">
                        @csrf
                        <div class="modal-header">						
                            <h4 class="modal-title">Delete Kandidat</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <p>Are you sure you want to delete Paslon no {{$kandidat->nomor_pasangan}}, {{$kandidat->nama_kepala}} & {{$kandidat->nama_wakil_kepala}}'s data?</p>
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