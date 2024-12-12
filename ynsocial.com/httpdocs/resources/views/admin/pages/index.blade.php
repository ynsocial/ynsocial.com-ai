@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Pages</h1>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">Add New Page</a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Add table rows here -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 