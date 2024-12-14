@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Analytics Dashboard</h1>
        <div class="d-flex align-items-center">
            <div class="input-group me-2">
                <input type="date" class="form-control" id="startDate" value="{{ $startDate->format('Y-m-d') }}">
                <span class="input-group-text">to</span>
                <input type="date" class="form-control" id="endDate" value="{{ $endDate->format('Y-m-d') }}">
            </div>
            <button class="btn btn-primary" onclick="refreshStats()">
                <i class="fas fa-sync"></i> Update
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Submissions
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalSubmissions">
                                {{ $stats['total_submissions'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                New Submissions
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="newSubmissions">
                                {{ $stats['new_submissions'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-inbox fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Average Response Time
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="avgResponseTime">
                                {{ round($stats['average_response_time']) }} minutes
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Submission Trend Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Submission Trend</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="submissionTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Distribution Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Distribution</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie">
                        <canvas id="statusDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Response Time and Categories Row -->
    <div class="row">
        <!-- Response Time Distribution -->
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Response Time Distribution</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="responseTimeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Categories -->
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top Categories</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="categoriesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let submissionTrendChart, statusDistributionChart, responseTimeChart, categoriesChart;

function initCharts(data) {
    // Submission Trend Chart
    const trendCtx = document.getElementById('submissionTrendChart').getContext('2d');
    submissionTrendChart = new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: data.submission_trend.map(item => item.date),
            datasets: [{
                label: 'Submissions',
                data: data.submission_trend.map(item => item.count),
                borderColor: 'rgb(78, 115, 223)',
                tension: 0.1
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Status Distribution Chart
    const statusCtx = document.getElementById('statusDistributionChart').getContext('2d');
    statusDistributionChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: data.submission_by_status.map(item => item.status),
            datasets: [{
                data: data.submission_by_status.map(item => item.count),
                backgroundColor: [
                    'rgb(78, 115, 223)',
                    'rgb(28, 200, 138)',
                    'rgb(246, 194, 62)'
                ]
            }]
        },
        options: {
            maintainAspectRatio: false
        }
    });

    // Response Time Distribution Chart
    const responseTimeCtx = document.getElementById('responseTimeChart').getContext('2d');
    responseTimeChart = new Chart(responseTimeCtx, {
        type: 'bar',
        data: {
            labels: data.response_time_distribution.map(item => item.response_range),
            datasets: [{
                label: 'Responses',
                data: data.response_time_distribution.map(item => item.count),
                backgroundColor: 'rgb(78, 115, 223)'
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Categories Chart
    const categoriesCtx = document.getElementById('categoriesChart').getContext('2d');
    categoriesChart = new Chart(categoriesCtx, {
        type: 'bar',
        data: {
            labels: data.top_categories.map(item => item.category),
            datasets: [{
                label: 'Submissions',
                data: data.top_categories.map(item => item.count),
                backgroundColor: 'rgb(78, 115, 223)'
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function updateCharts(data) {
    // Update stats cards
    document.getElementById('totalSubmissions').textContent = data.total_submissions;
    document.getElementById('newSubmissions').textContent = data.new_submissions;
    document.getElementById('avgResponseTime').textContent = Math.round(data.average_response_time) + ' minutes';

    // Update charts
    submissionTrendChart.data.labels = data.submission_trend.map(item => item.date);
    submissionTrendChart.data.datasets[0].data = data.submission_trend.map(item => item.count);
    submissionTrendChart.update();

    statusDistributionChart.data.labels = data.submission_by_status.map(item => item.status);
    statusDistributionChart.data.datasets[0].data = data.submission_by_status.map(item => item.count);
    statusDistributionChart.update();

    responseTimeChart.data.labels = data.response_time_distribution.map(item => item.response_range);
    responseTimeChart.data.datasets[0].data = data.response_time_distribution.map(item => item.count);
    responseTimeChart.update();

    categoriesChart.data.labels = data.top_categories.map(item => item.category);
    categoriesChart.data.datasets[0].data = data.top_categories.map(item => item.count);
    categoriesChart.update();
}

function refreshStats() {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;

    $.get('/admin/analytics', { start_date: startDate, end_date: endDate }, function(data) {
        updateCharts(data);
    });
}

// Initialize charts when the page loads
$(document).ready(function() {
    initCharts(@json($stats));
});
</script>
@endpush
