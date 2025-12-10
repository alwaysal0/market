@vite('resources/css/modules/profile/your-reports.css')

<div id="your-reports__cont">
    @foreach($reports as $report)
        <div>
            <div class="your-reports__card">
                <div class="your-reports__card-box">
                    <span class="your-reports__card-box-name">Content</span>
                    <span class="your-reports__card-content">{{ $report->content }}</span>
                </div>
                <div class="your-reports__card-box">
                    <span class="your-reports__card-box-name">Status</span>
                    <span class="your-reports__card-status your-reports__card-value" style="color:{{ $report->status == "1" ? "#155724" : "#721c24" }}">
                        {{ $report->status == "1" ? "Opened" : "Closed" }}
                    </span>
                </div>
                <div class="your-reports__card-box">
                    <span class="your-reports__card-box-name">Date</span>
                    <span class="your-reports__card-date your-reports__card-value">{{ $report->created_at }}</span>
                </div>
                <a class="your-reports__card-button" href="{{ route("profile.your-reports.report", ['report' => $report]) }}">Show</a>
            </div>
        </div>
    @endforeach
</div>
