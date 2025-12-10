@extends('layouts.app')

@vite('resources/css/modules/report.css')
@section('title', "Test")
@section('content')
    <a id="report-data__hotlink" href="{{ route('profile.your-reports') }}">To Reports</a>
    <p id="report-tittle">Report {{ $report->id }}</p>
    <div class="your-report__box">
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
        <div class="report-data__box report-content-box">
            <span>Content:</span>
            <p>{{ $report->content }}</p>
        </div>
        <div class="report-data__box report-response-box">
            <span>Response:</span>
            @if($response)
                <p>{{ $response->content }}</p>
            @else
                Unfortunately, no one has responded to your report yet.
            @endif
        </div>
    </div>
@endsection

