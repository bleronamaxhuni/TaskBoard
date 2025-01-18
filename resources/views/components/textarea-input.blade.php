<textarea {{ $attributes->merge([
    'rows' => '3',
    'class' => 'w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500'
]) }}>{{ $slot }}</textarea>