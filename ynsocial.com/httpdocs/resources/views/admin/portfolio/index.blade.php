@extends('admin.layouts.app')

@section('title', 'Portfolio Management')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Portfolio Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Portfolio</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Action Buttons -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary float-right">
                        <i class="fas fa-plus"></i> Add New Project
                    </a>
                </div>
            </div>

            <!-- Portfolio List -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Portfolio Projects</h3>
                    <div class="card-tools">
                        <form action="{{ route('admin.portfolio.index') }}" method="GET" class="input-group input-group-sm" style="width: 250px;">
                            <input type="text" name="search" class="form-control float-right" placeholder="Search projects..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($portfolios as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>
                                        <img src="{{ asset($project->thumbnail) }}" alt="{{ $project->title }}" class="img-thumbnail" width="50">
                                    </td>
                                    <td>{{ $project->title }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $project->category->name }}</span>
                                    </td>
                                    <td>
                                        @if($project->is_published)
                                            <span class="badge badge-success">Published</span>
                                        @else
                                            <span class="badge badge-warning">Draft</span>
                                        @endif
                                    </td>
                                    <td>{{ $project->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.portfolio.edit', $project) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.portfolio.show', $project) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.portfolio.destroy', $project) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No portfolio projects found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($portfolios->hasPages())
                    <div class="card-footer clearfix">
                        {{ $portfolios->links() }}
                    </div>
                @endif
            </div>

            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalProjects }}</h3>
                            <p>Total Projects</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $publishedProjects }}</h3>
                            <p>Published Projects</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $draftProjects }}</h3>
                            <p>Draft Projects</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $categories->count() }}</h3>
                            <p>Categories</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-folder"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .table td, .table th {
            vertical-align: middle;
        }
        .btn-group {
            display: flex;
            gap: 5px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Enable tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Handle bulk actions
            $('#bulk-action').on('change', function() {
                if (this.value) {
                    if (confirm('Are you sure you want to perform this action on selected items?')) {
                        $('#bulk-form').submit();
                    }
                    this.value = '';
                }
            });
        });
    </script>
@endpush 