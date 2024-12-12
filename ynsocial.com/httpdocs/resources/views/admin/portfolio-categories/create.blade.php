@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Create Portfolio Category</h1>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.portfolio-categories.store') }}">
                @csrf
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection 