@extends('layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">State List</div>
            <div class="card-body">
                <a href="{{ route('state.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New State</a>
                <form action="{{ route('state.import') }}" method="post" enctype="multipart/form-data" id="importForm">
                    @csrf
                    <div class="mb-3 row">
                        <label for="file" class="col-md-4 col-form-label text-md-end text-start">Import CSV</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" onchange="document.getElementById('importForm').submit();">
                            @if ($errors->has('file'))
                                <span class="text-danger">{{ $errors->first('file') }}</span>
                            @endif
                        </div>
                    </div>
                </form>
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Sr No#</th>
                        <th scope="col">State Name</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($states as $state)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $state->name ?? '-' }}</td>
                            <td>
                                <form action="{{ route('state.destroy', $state->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('state.edit', $state->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this state?');"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>No State Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                  </table>

                  {{ $states->links('pagination::bootstrap-5') }}

            </div>
        </div>
    </div>    
</div>
    
@endsection