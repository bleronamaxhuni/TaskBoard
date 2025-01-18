@extends('layouts.master')

@section('content')
    <div class="flex w-full justify-between py-9">
        <h1 class="text-3xl font-bold">Tags</h1>
    </div>

    {{-- Tag Creation Form --}}
    <div class="pt-4">
        <div class="flex justify-end w-full mb-5">
            <form action="{{ route('tags.store') }}" method="POST"
                class="w-5/12 flex border-2 border-transparent rounded-lg text-gray-600 font-medium focus:ring focus:ring-blue-50 bg-white shadow-sm">
                @csrf
                <input type="text" 
                    name="name" 
                    value="{{ old('name') }}" 
                    placeholder="New Tag"
                    class="w-10/12 relative flex-auto block px-3 py-1.5 text-base font-normal text-gray-700 bg-clip-padding focus:border-blue-600 focus:outline-none"
                    required>
                <button type="submit"
                    class="btn inline-block px-4 py-2 bg-blue-500 text-white rounded-lg focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                    Create
                </button>
            </form>
        </div>
    </div>

    {{-- Tags Table --}}
    <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden mt-10">
        <table class="min-w-full leading-normal bg-white">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Title
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($tags as $tag)
                    <tr class="border-b border-gray-200">
                        <td class="px-5 py-5 bg-white text-sm">
                            <div class="flex">
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $tag->name }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 bg-white text-sm">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('tags.edit', $tag) }}"
                                    class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200"
                                            onclick="return confirm('Are you sure you want to delete this tag?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-5 py-5 text-bold text-center">
                            No tags found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection