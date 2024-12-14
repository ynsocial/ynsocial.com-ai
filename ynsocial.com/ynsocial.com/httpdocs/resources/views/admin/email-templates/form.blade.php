@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{ isset($template) ? 'Edit Template' : 'Create Template' }}
        </h1>
        <a href="{{ route('admin.email-templates.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Templates
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ isset($template) 
                ? route('admin.email-templates.update', $template) 
                : route('admin.email-templates.store') }}" 
                  method="POST">
                @csrf
                @if(isset($template))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="name">Template Name</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $template->name ?? '') }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="subject">Email Subject</label>
                    <input type="text" 
                           class="form-control @error('subject') is-invalid @enderror" 
                           id="subject" 
                           name="subject" 
                           value="{{ old('subject', $template->subject ?? '') }}" 
                           required>
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Email Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              id="content" 
                              name="content" 
                              rows="10" 
                              required>{{ old('content', $template->content ?? '') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        Available variables: {{name}}, {{email}}, {{subject}}, {{message}}
                    </small>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="3">{{ old('description', $template->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" 
                               class="custom-control-input" 
                               id="is_active" 
                               name="is_active" 
                               value="1" 
                               {{ old('is_active', $template->is_active ?? true) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Active</label>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($template) ? 'Update Template' : 'Create Template' }}
                    </button>
                    <a href="{{ route('admin.email-templates.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: '#content',
    height: 400,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | bold italic backcolor | \
             alignleft aligncenter alignright alignjustify | \
             bullist numlist outdent indent | removeformat | help'
});
</script>
@endpush
