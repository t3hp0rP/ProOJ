<div class="row">
    <div class="col-md-12">
        @if(isset($errorMessage) && $errorMessage != '')
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @elseif(isset($successMessage) && $successMessage != '')
            <div class="alert alert-success">
                {{ $successMessage }}
            </div>
        @endif
    </div>
</div>