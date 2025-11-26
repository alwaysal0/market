@extends('layouts.app')
@section('title', 'Market - Report ' . $report->id)
@vite('resources/css/admin/report.css ')
@section('content')
    <a href="{{ route('admin.showReports', ['status' => "opened"]) }}" id="report-back">To reports</a>
    <p id="report-tittle">Report {{ $report->id }}</p>
    <div class="admin-report__box">
        <div class="report-data__box">
            <span>User ID:</span>
            <p>{{ $report->user_id }}</p>
        </div>
        <div class="report-data__box">
            <span>Status:</span>
            @if ($report->status == 1)
                <p style="color: #28a745; font-weight: 700">Opened</p>
            @else
                <p style="color: #dc3545; font-weight: 700">Closed</p>
            @endif
        </div>
        <div class="report-data__box">
            <span>Created at:</span>
            <p>{{ $report->created_at }}</p>
        </div>
        <div class="report-data__box">
            <span>Content:</span>
            <p>{{ $report->content }}</p>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.replyReport', ['report' => $report]) }}">
        @csrf
        <textarea name="response" required></textarea>
        @if($report->status == 1)
            <button type="submit">Reply</button>
        @else
            <button type="submit" style="filter: grayscale(1)" disabled>Reply</button>
        @endif
    </form>
@endsection
