<div class="row">
    <!-- Theme Status Cards -->
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-lg bg-primary-transparent">
                        <i class="fas fa-puzzle-piece fs-20"></i>
                    </div>
                    <div class="ms-3">
                        <p class="mb-0 fs-13 text-muted">Active Components</p>
                        <h4 class="mt-0 mb-0 fs-22">{{ $data['activeComponents'] }}/{{ $data['totalComponents'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-lg bg-success-transparent">
                        <i class="fas fa-code-branch fs-20"></i>
                    </div>
                    <div class="ms-3">
                        <p class="mb-0 fs-13 text-muted">Theme Version</p>
                        <h4 class="mt-0 mb-0 fs-22">{{ $data['themeVersion'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-lg bg-warning-transparent">
                        <i class="fas fa-clock fs-20"></i>
                    </div>
                    <div class="ms-3">
                        <p class="mb-0 fs-13 text-muted">Last Updated</p>
                        <h4 class="mt-0 mb-0 fs-22">{{ $data['lastUpdated']->diffForHumans() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card mt-4">
    <div class="card-header">
        <h6 class="card-title mb-0">Quick Actions</h6>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <a href="#components" class="btn btn-outline-primary btn-lg w-100" data-bs-toggle="tab">
                    <i class="fas fa-puzzle-piece me-2"></i>Manage Components
                </a>
            </div>
            <div class="col-md-4">
                <a href="#settings" class="btn btn-outline-primary btn-lg w-100" data-bs-toggle="tab">
                    <i class="fas fa-cog me-2"></i>Theme Settings
                </a>
            </div>
            <div class="col-md-4">
                <a href="#layout" class="btn btn-outline-primary btn-lg w-100" data-bs-toggle="tab">
                    <i class="fas fa-columns me-2"></i>Edit Layout
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="card mt-4">
    <div class="card-header">
        <h6 class="card-title mb-0">Recent Activity</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <tbody>
                    @foreach($data['settings']->take(5) as $setting)
                    <tr>
                        <td>
                            <i class="fas fa-edit text-primary me-2"></i>
                            Updated {{ $setting->label }}
                        </td>
                        <td class="text-muted">{{ $setting->updated_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
