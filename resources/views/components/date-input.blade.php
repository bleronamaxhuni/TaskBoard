@props(['value' => null])

<input type="date" value="{{ old($attributes->get('name'), $value) }}" {{ $attributes->merge([
'class' => 'w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500'
]) }}
>