@extends('admin.layout')

@section('title')
    <h1>Daftar Token</h1>
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
							<th>NIK</th>
							<th>Token</th>
							<th>Status</th>
							<th>Tanggal Penggunaan</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($tokens as $token)
                            <tr>
                                <td>{{ $token->penduduk->KK }}</td>
                                <td>{{ $token->token }}</td>
								@if ($token->penggunaan === 0)
									<td>Belum Memilih</td>
								@else
									<td>Sudah Memilih</td>
								@endif
                                <td>{{ $token->use_date }}</td>
                                <td>
                                    <a href="#deleteModal-{{$token->id}}" class="delete" data-toggle="modal"><i class="material-icons text-danger" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
				<form method="POST" action="{{route('token.store')}}" accept-charset="UTF-8">
                    @csrf
					<div class="modal-header">
						<h4 class="modal-title">Add Token</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        <div class="form-group">
							<label for="id_penduduks" class="control-label">Pemilih</label>
							{{-- <input id="" list="id_penduduks" class="form-control" name="id_penduduks" required> --}}
							{{-- <datalist id="id_penduduks">
								@foreach ($penduduks as $penduduk)
									<option value="{{ $penduduk->id }}">{{ $penduduk->KTP . '/' . $penduduk->nama }}</option>
								@endforeach
							</datalist> --}}
							<select name="id_penduduks" id="id_penduduks" class="form-select" required>
								{{-- <option value="None" selected>Daftar Pemilih</option> --}}
								@foreach ($penduduks as $penduduk)
								@if (old('id_penduduk') === $penduduk)
									<option value="{{ $penduduk->id }}" selected>{{ $penduduk->KTP . '/' . $penduduk->nama }}</option>
								@else
									<option value="{{ $penduduk->id }}">{{ $penduduk->KTP . '/' . $penduduk->nama }}</option>
								@endif
								@endforeach
							</select>
						</div>
                        <div class="form-group">
                            <label>Tanggal Penggunaan</label>
                            <input id="use_date" name="use_date" type="date" class="form-control" required>
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

    @foreach ($tokens as $token)
		<!-- Delete Modal HTML -->
        <div id="deleteModal-{{$token->id}}" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{route('token.destroy', $token->id)}}">
                        @csrf
                        <div class="modal-header">						
                            <h4 class="modal-title">Delete Penduduk</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">					
                            <p>Are you sure you want to delete {{$token->token}}, NIK {{$token->penduduk->KTP}}/{{$token->penduduk->nama}}'s data?</p>
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