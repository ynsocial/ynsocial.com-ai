@extends('admin.montoya.content.layout')

@section('title', 'Team Members')

@section('content-area')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Team Members</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.montoya.team.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Member
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50px">ID</th>
                                <th style="width: 80px">Image</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th style="width: 100px">Order</th>
                                <th style="width: 150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($members as $member)
                                <tr>
                                    <td>{{ $member->id }}</td>
                                    <td>
                                        @if($member->image)
                                            <img src="{{ Storage::url($member->image) }}" 
                                                 alt="{{ $member->name }}" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 50px">
                                        @else
                                            <span class="badge badge-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->position }}</td>
                                    <td>{{ $member->order ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('admin.montoya.team.edit', $member) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.montoya.team.destroy', $member) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this member?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No team members found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($members->hasPages())
                <div class="card-footer">
                    {{ $members->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('additional-styles')
<style>
    .table img {
        transition: transform 0.2s;
    }
    .table img:hover {
        transform: scale(2);
        cursor: pointer;
    }
</style>
@endsection
