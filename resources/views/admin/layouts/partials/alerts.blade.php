@if (Session::has('success') || session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') ?? Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif
@if (Session::has('error') || session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') ?? Session::get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif
@if ($errors->any() && !($hideValidationErrors ?? false))
    <div class="alert alert-danger" role="alert">
        <p class="mb-1 font-weight-bold">Please fix the following:</p>
        <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif
