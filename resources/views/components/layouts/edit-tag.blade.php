<tbody>
    <thead>
        <tr>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                Title
            </th>
            <th
                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-xs font-semibold text-gray-700 uppercase tracking-wider text-center">
                Action
            </th>
        </tr>
    </thead>
    <tr class="border-b border-gray-200">
        <form action="/tags/{{$tag['id']}}" method="POST">
            @csrf
            @method('PATCH')
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <input type="text" name="name" value="{{old('name', $tag['name'])}}" id="name"
                    class="w-10/12 relative flex-auto block  px-3 py-1.5 text-base font-normal text-gray-700 bg-clip-padding  focus:border-blue-600 focus:outline-none "
                    >
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <button type="submit"
                    class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700">Update
                    Tag</button>
            </td>
        </form>
    </tr>
</tbody>