@if (Session::has('message'))
    <div class="text-center bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        {{ Session::get('message') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="text-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        {{ Session::get('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="text-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif