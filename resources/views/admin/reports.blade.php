@extends('layouts.app')
@section('title', 'Market - Reports')
@section('content')
@vite('resources/css/admin/reports.css')

<div id="admin-report__box">
    @foreach($reports as $report)
        <div class="admin-report__card">
            <div class="admin-report__card-box">
                <span class="admin-report__card-box-name">User ID</span>
                <span class="admin-report__card-user_id">{{ $report->user_id }}</span>
            </div>
            <div class="admin-report__card-box">
                <span class="admin-report__card-box-name">Content</span>
                <span class="admin-report__card-content">{{ $report->content }}</span>
            </div>
            <div class="admin-report__card-box">
                <span class="admin-report__card-box-name">Status</span>
                <span class="admin-report__card-status" style="color:{{ $report->status == "1" ? "#155724" : "#721c24" }}">
                    {{ $report->status == "1" ? "Opened" : "Closed" }}
                </span>
            </div>
            <div class="admin-report__card-box">
                <span class="admin-report__card-box-name">Date</span>
                <span class="admin-report__card-date">{{ $report->created_at }}</span>
            </div>
            <a href="{{ route("admin.showReport", ['report' => $report]) }}">Answer</a>
        </div>
    @endforeach
</div>

@endsection
