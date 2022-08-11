<div class="alert-{{$level}}{{$alert_set}}" role="alert" id="js-alert{{$important}}">
    <div class="alert-top-row">
        <div><span class="alert-icon"></span></div>
        <div class="alert-level">{{ display($level, 'f') }}</div>
        <div class="alert-close"><span class="far fa-times-circle" id="js-alert-close"></span></div>
    </div>
    <div class="alert-body">
        <div class="alert-message">
            <p>
                <span class="alert-message-title">{{ $title ? "$title: " : ""}} </span>
                <span class="alert-message-text">{{$message}}</span>
            </p>
        </div>
    </div>
</div>
