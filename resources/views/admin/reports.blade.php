@extends('layouts.app')
@section('title', 'Market - Reports')
@section('content')
@vite('resources/css/admin/reports.css')

<p id="admin-report__title">Reports</p>
<div id="admin-report__box">
    @foreach($reports as $report)
        <div class="admin-report__card">
            <div class="your-reports__card-box">
                <span class="your-reports__card-box-name">User ID</span>
                <span class="admin-report__card-user_id admin-report__card-value">{{ $report->user_id }}</span>
            </div>
            <div class="your-reports__card-box">
                <span class="your-reports__card-box-name">Content</span>
                <span class="admin-report__card-content">{{ $report->content }}</span>
            </div>
            <div class="your-reports__card-box">
                <span class="your-reports__card-box-name">Status</span>
                <span class="admin-report__card-status admin-report__card-value" style="color:{{ $report->status == "1" ? "#155724" : "#721c24" }}">
                    {{ $report->status == "1" ? "Opened" : "Closed" }}
                </span>
            </div>
            <div class="your-reports__card-box">
                <span class="your-reports__card-box-name">Date</span>
                <span class="admin-report__card-date admin-report__card-value">{{ $report->created_at }}</span>
            </div>
            <a class="your-reports__card-button" href="{{ route("admin.showReport", ['report' => $report]) }}">Reply</a>
        </div>
    @endforeach
</div>

@endsection
