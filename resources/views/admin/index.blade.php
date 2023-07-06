@extends('admin.layout')

@section('title')
    <h1>Daftar Admin</h1>
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
							<th>Nama</th>
							<th>Email</th>
							<th>Banjar</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->nama }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->banjar->nama }}</td>
                                <td>{{ $admin->status }}</td>
                                <td>
                                    <a href="#editModal-{{$admin->id}}" class="edit" data-toggle="modal"><i class="material-icons text-warning" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <a href="#deleteModal-{{$admin->id}}" class="delete" data-toggle="modal"><i class="material-icons text-danger" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
				<form method="POST" action="{{route('admin.store')}}" accept-charset="UTF-8">
                    @csrf
					<div class="modal-header">						
						<h4 class="modal-title">Add Admin</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Nama</label>
							<input id="nama" name="nama" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input id="email" name="email" type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input id="password" name="password" type="text" class="form-control" required>
						</div>
						<div class="form-group">
                            <label for="banjar_id" class="control-label">Banjar</label>
                            <input id="" list="banjar_id" class="form-control" name="banjar_id" required>
                            <datalist id="banjar_id">
                                @foreach ($banjars as $banjar)
                                    <option value="{{ $banjar->id }}">{{ $banjar->nama }}</option>
                                @endforeach
                            </datalist>
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

    @foreach ($admins as $admin)

	    <!-- Edit Modal HTML -->
        <div id="editModal-{{$admin->id}}" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{route('admin.update', $admin->id)}}" accept-charset="UTF-8">
                        @csrf
                        <div class="modal-header">						
                            <h4 class="modal-title">Update Admin</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <div class="form-group">
                                <label>Nama</label>
                                <input id="nama" name="nama" type="text" class="form-control" value="{{$admin->nama}}" required>
                            </div>
                            <div class="form-group">
                                <label for="banjar_id" class="control-label">Banjar</label>
                                <input id="" list="banjar_id" class="form-control" name="banjar_id" value="{{$admin->id_banjars}}" required>
                                <datalist id="banjar_id">
                                    @foreach ($banjars as $banjar)
                                        <option value="{{ $banjar->id }}">{{ $banjar->nama }}</option>
                                    @endforeach
                                </datalist>
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
        <div id="deleteModal-{{$admin->id}}" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{route('admin.destroy', $admin->id)}}">
                        @csrf
                        <div class="modal-header">						
                            <h4 class="modal-title">Delete Admin</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <p>Are you sure you want to delete {{$admin->nama}}'s data?</p>
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