@if($errors->all())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p><br>
        @endforeach
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif