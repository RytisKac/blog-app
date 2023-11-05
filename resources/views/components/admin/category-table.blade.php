
@props(['categories'])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-auto">
    <table class="w-full text-sm text-left text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Slug
                </th>
                <th scope="col" class="px-6 py-3">
                    Post count
                </th>
                <th scope="col" colspan="2" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr class="bg-white border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{$category->name}}
                </th>
                <td class="px-6 py-4">
                    {{$category->slug}}
                </td>
                <td class="px-6 py-4">
                    <a href="{{route('admin.category.show', ['category' => $category])}}" class="font-medium text-blue-600 hover:underline">
                        {{$category->posts->count()}}
                    </a>
                </td>
                <td class="px-6 py-4">
                    <a href="{{route('admin.category.edit', ['category' => $category])}}" class="font-medium text-blue-600 hover:underline">Edit</a>
                </td>
                <td class="px-6 py-4">
                    <form method="POST" action="{{route('admin.category.destroy', ['category' => $category])}}">
                        @method('DELETE')
                        @csrf
                        <button class="font-medium text-blue-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr class="bg-white border-b">
                <td class="px-6 py-4" colspan="4">
                    No categories yet
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
