@extends('layouts.master')

@section('content')
    <div class="flex w-full justify-between py-9">
        <h1 class="text-3xl font-bold">Tags</h1>
        <button onclick="openCreateModal()"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
            <i class="fa-solid fa-plus mr-2"></i>New Tag
        </button>
    </div>

    {{-- Add the create modal markup --}}
    <div id="createTagModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Create New Tag</h3>
                    <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
                <form id="createTagForm" action="{{ route('tags.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="createTagName" class="block text-sm font-medium text-gray-700 mb-1">Tag Name</label>
                        <input type="text" name="name" id="createTagName"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                        <div class="flex flex-wrap gap-3">
                            <label class="color-picker-option">
                                <input type="radio" name="color" value="red" class="sr-only peer" required>
                                <div
                                    class="w-8 h-8 rounded-full bg-red-500 cursor-pointer ring-2 ring-transparent hover:ring-red-200 peer-checked:ring-red-500 peer-checked:ring-offset-2 transition-all duration-200">
                                </div>
                            </label>
                            <label class="color-picker-option">
                                <input type="radio" name="color" value="blue" class="sr-only peer">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-500 cursor-pointer ring-2 ring-transparent hover:ring-blue-200 peer-checked:ring-blue-500 peer-checked:ring-offset-2 transition-all duration-200">
                                </div>
                            </label>
                            <label class="color-picker-option">
                                <input type="radio" name="color" value="green" class="sr-only peer">
                                <div
                                    class="w-8 h-8 rounded-full bg-green-500 cursor-pointer ring-2 ring-transparent hover:ring-green-200 peer-checked:ring-green-500 peer-checked:ring-offset-2 transition-all duration-200">
                                </div>
                            </label>
                            <label class="color-picker-option">
                                <input type="radio" name="color" value="yellow" class="sr-only peer">
                                <div
                                    class="w-8 h-8 rounded-full bg-yellow-500 cursor-pointer ring-2 ring-transparent hover:ring-yellow-200 peer-checked:ring-yellow-500 peer-checked:ring-offset-2 transition-all duration-200">
                                </div>
                            </label>
                            <label class="color-picker-option">
                                <input type="radio" name="color" value="orange" class="sr-only peer">
                                <div
                                    class="w-8 h-8 rounded-full bg-orange-500 cursor-pointer ring-2 ring-transparent hover:ring-orange-200 peer-checked:ring-orange-500 peer-checked:ring-offset-2 transition-all duration-200">
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                        <div class="tag-preview px-4 py-2 rounded-lg shadow-sm border bg-gray-100">
                            <i class="fas fa-tag mr-2"></i>
                            <span class="preview-text">Sample Tag</span>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeCreateModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Tag Modal --}}
    <div id="editTagModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Edit Tag</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
                <form id="editTagForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="editTagName" class="block text-sm font-medium text-gray-700 mb-1">Tag Name</label>
                        <input type="text" name="name" id="editTagName"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                        <div class="flex flex-wrap gap-3">
                            <label class="color-picker-option">
                                <input type="radio" name="color" value="red" class="sr-only peer" required>
                                <div
                                    class="w-8 h-8 rounded-full bg-red-500 cursor-pointer ring-2 ring-transparent hover:ring-red-200 peer-checked:ring-red-500 peer-checked:ring-offset-2 transition-all duration-200">
                                </div>
                            </label>
                            <label class="color-picker-option">
                                <input type="radio" name="color" value="blue" class="sr-only peer">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-500 cursor-pointer ring-2 ring-transparent hover:ring-blue-200 peer-checked:ring-blue-500 peer-checked:ring-offset-2 transition-all duration-200">
                                </div>
                            </label>
                            <label class="color-picker-option">
                                <input type="radio" name="color" value="green" class="sr-only peer">
                                <div
                                    class="w-8 h-8 rounded-full bg-green-500 cursor-pointer ring-2 ring-transparent hover:ring-green-200 peer-checked:ring-green-500 peer-checked:ring-offset-2 transition-all duration-200">
                                </div>
                            </label>
                            <label class="color-picker-option">
                                <input type="radio" name="color" value="yellow" class="sr-only peer">
                                <div
                                    class="w-8 h-8 rounded-full bg-yellow-500 cursor-pointer ring-2 ring-transparent hover:ring-yellow-200 peer-checked:ring-yellow-500 peer-checked:ring-offset-2 transition-all duration-200">
                                </div>
                            </label>
                            <label class="color-picker-option">
                                <input type="radio" name="color" value="orange" class="sr-only peer">
                                <div
                                    class="w-8 h-8 rounded-full bg-orange-500 cursor-pointer ring-2 ring-transparent hover:ring-orange-200 peer-checked:ring-orange-500 peer-checked:ring-offset-2 transition-all duration-200">
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                        <div class="tag-preview px-4 py-2 rounded-lg shadow-sm border bg-gray-100">
                            <i class="fas fa-tag mr-2"></i>
                            <span class="preview-text">Sample Tag</span>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Tags Table --}}
    <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden mt-10">
        <table class="min-w-full leading-normal bg-white">
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
            <tbody>
                @forelse($tags as $tag)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-5 py-5">
                            <div class="flex items-center">
                                <span
                                    class="px-4 py-2 rounded-lg shadow-sm 
                                    {{ match ($tag->color) {
                                        'yellow' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                        'red' => 'bg-red-100 text-red-800 border border-red-200',
                                        'blue' => 'bg-blue-100 text-blue-800 border border-blue-200',
                                        'green' => 'bg-green-100 text-green-800 border border-green-200',
                                        'orange' => 'bg-orange-100 text-orange-800 border border-orange-200',
                                        default => 'bg-gray-100 text-gray-800 border border-gray-200',
                                    } }}">
                                    <i
                                        class="fas fa-tag mr-2 
                                        {{ match ($tag->color) {
                                            'yellow' => 'text-yellow-500',
                                            'red' => 'text-red-500',
                                            'blue' => 'text-blue-500',
                                            'green' => 'text-green-500',
                                            'orange' => 'text-orange-500',
                                            default => 'text-gray-500',
                                        } }}"></i>
                                    {{ $tag->name }}
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-5">
                            <div class="flex justify-center space-x-3">
                                <button onclick="openEditModal('{{ $tag->id }}', '{{ $tag->name }}', '{{ $tag->color }}')"
                                    class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 group">
                                    <i class="fa-solid fa-pen-to-square group-hover:scale-110 transition-transform"></i>
                                </button>
                                <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200 group"
                                        onclick="return confirm('Are you sure you want to delete this tag?')">
                                        <i class="fa-solid fa-trash group-hover:scale-110 transition-transform"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-5 py-8 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-500">
                                <i class="fas fa-tags text-4xl mb-3"></i>
                                <p class="text-lg">No tags found</p>
                                <button onclick="openCreateModal()"
                                    class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                    Create your first tag
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function openEditModal(id, name, color) {
            document.getElementById('editTagModal').classList.remove('hidden');
            document.getElementById('editTagName').value = name;
            const colorInput = document.querySelector(`#editTagModal input[type="radio"][value="${color}"]`);
            if (colorInput) {
                colorInput.checked = true;
            }
            document.getElementById('editTagForm').action = `/tags/${id}`;
            updateColorPreview('editTagForm');
        }

        function closeModal() {
            document.getElementById('editTagModal').classList.add('hidden');
        }

        function openCreateModal() {
            document.getElementById('createTagForm').reset();
            const modal = document.getElementById('createTagModal');
            modal.classList.remove('hidden');
            document.getElementById('createTagName').focus();
            // Select first color by default
            const firstColorInput = modal.querySelector('input[type="radio"]');
            if (firstColorInput) {
                firstColorInput.checked = true;
                updateColorPreview('createTagForm');
            }
        }

        function closeCreateModal() {
            const modal = document.getElementById('createTagModal');
            modal.classList.add('hidden');
        }

        function updateColorPreview(formId) {
            const form = document.getElementById(formId);
            const selectedColor = form.querySelector('input[name="color"]:checked')?.value;
            const preview = form.querySelector('.tag-preview');
            const previewIcon = preview.querySelector('i');
            const previewText = preview.querySelector('.preview-text');
            const tagName = form.querySelector('input[name="name"]').value || 'Sample Tag';

            if (!preview || !selectedColor) return;

            // Remove existing classes
            preview.className = 'tag-preview px-4 py-2 rounded-lg shadow-sm border';
            previewIcon.className = 'fas fa-tag mr-2';

            // Add new classes based on selected color
            const colorClasses = {
                'yellow': 'bg-yellow-100 text-yellow-800 border-yellow-200',
                'red': 'bg-red-100 text-red-800 border-red-200',
                'blue': 'bg-blue-100 text-blue-800 border-blue-200',
                'green': 'bg-green-100 text-green-800 border-green-200',
                'orange': 'bg-orange-100 text-orange-800 border-orange-200'
            };

            const iconColorClasses = {
                'yellow': 'text-yellow-500',
                'red': 'text-red-500',
                'blue': 'text-blue-500',
                'green': 'text-green-500',
                'orange': 'text-orange-500'
            };

            preview.classList.add(...(colorClasses[selectedColor]?.split(' ') || []));
            previewIcon.classList.add(iconColorClasses[selectedColor] || '');
            previewText.textContent = tagName;
        }

        // Event Listeners
        document.getElementById('createTagModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreateModal();
            }
        });

        document.getElementById('editTagModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeCreateModal();
            }
        });

        // Form submissions
        document.getElementById('createTagForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin'
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    closeCreateModal();
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while creating the tag');
                });
        });

        document.getElementById('editTagForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin'
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    closeModal();
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the tag');
                });
        });

        // Add color preview update listeners
        document.querySelectorAll('input[name="color"]').forEach(input => {
            input.addEventListener('change', (e) => {
                const formId = e.target.closest('form').id;
                updateColorPreview(formId);
            });
        });

        document.querySelectorAll('input[name="name"]').forEach(input => {
            input.addEventListener('input', (e) => {
                const formId = e.target.closest('form').id;
                updateColorPreview(formId);
            });
        });
    </script>

    <style>
        .color-picker-option input:checked+div {
            transform: scale(1.1);
        }

        .color-picker-option input:focus+div {
            box-shadow: 0 0 0 2px white, 0 0 0 4px #4f46e5;
        }
    </style>
@endsection
