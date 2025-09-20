@vite('resources/css/modules/alerts.css')
@vite('resources/js/fadeAlerts.js')

@if(session('success'))
<div class="alert" id="alert-success">
    <p>{{ session('success') }}</p>
</div>
@elseif(session('info'))
<div class="alert" id="alert-info">
    <p>{{ session('info') }}</p>
</div>
@elseif(session('error'))
    <div class="alert" id="alert-error">
        <p>{{ session('error') }}</p>
    </div>
@endif
@if ($errors->any())
    <div class="alert" id="alert-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
