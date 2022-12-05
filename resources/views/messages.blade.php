@if ($message = Session::get('error'))
    <div class="alert message error fade-in mb-4" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ($errors->any())
    @if (request()->is('login*') || request()->is('register*'))
    @else
        <div class="alert message error fade-in mb-4" role="alert">
            <ul class="m-0 p-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li class="fw-bold">{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endif
@if ($message = Session::get('success'))
    <div class="alert message success fade-in mb-4" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
