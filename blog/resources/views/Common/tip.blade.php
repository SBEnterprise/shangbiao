@if (count($errors) > 0)
    <div class="alert alert-danger" style="text-align: center;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('msg'))
    <div class="alert alert-success" style="text-align: center;">
        {{ session('msg') }}
    </div>
@endif

@if (session('errorTip'))
    <div class="alert alert-danger" style="text-align: center;">
        {{ session('errorTip') }}
    </div>
@endif
