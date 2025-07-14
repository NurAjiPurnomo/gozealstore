<x-layouts.app :title="__('Categories')">
    <style>
        /* Tambahan style custom */
        .card-table {
            background: #fff;
            border-radius: .75rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }
        .card-table:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        }
        .table-header {
            background-color: #e0e0e0;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
        }
        tbody tr:hover {
            background-color: #f9f9f9;
        }
        .truncate-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .btn-add-category {
            background-color: #000;
            color: #fff;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease;
        }
        .btn-add-category:hover {
            background-color: #333;
        }
        .btn-actions {
            background-color: #f0f0f0;
            color: #000;
            font-weight: 500;
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s ease;
        }
        .btn-actions:hover {
            background-color: #dcdcdc;
        }

        /* Toggle Switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 20px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:checked + .slider:before {
            transform: translateX(20px);
        }

        /* Responsive styles for mobile */
        @media (max-width: 768px) {
            .card-table {
                box-shadow: none;
                border-radius: 0;
                overflow-x: visible;
            }
            table {
                border-collapse: separate;
                border-spacing: 0 0.75rem;
            }
            thead {
                display: none;
            }
            tbody tr {
                display: block;
                background: #fff;
                border-radius: 0.75rem;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                margin-bottom: 0.75rem;
                padding: 1rem;
            }
            tbody tr:hover {
                background-color: #f9f9f9;
                box-shadow: 0 4px 16px rgba(0,0,0,0.15);
            }
            tbody tr td {
                display: flex;
                justify-content: space-between;
                padding: 0.5rem 0;
                border: none;
                border-bottom: 1px solid #e0e0e0;
            }
            tbody tr td:last-child {
                border-bottom: none;
            }
            tbody tr td::before {
                content: attr(data-label);
                font-weight: 700;
                color: #333;
                flex-basis: 50%;
                text-align: left;
            }
        }
    </style>

    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Product Categories</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage product categories easily and quickly</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-2">
        <form action="{{ route('categories.index') }}" method="get" class="w-full md:w-auto">
            <flux:input icon="magnifying-glass" name="q" value="{{ $q }}" placeholder="Search categories..." />
        </form>
        <flux:button icon="plus" class="btn-add-category">
            <flux:link href="{{ route('categories.create') }}" variant="subtle">Add New Category</flux:link>
        </flux:button>
    </div>

    @if(session()->has('successMessage'))
        <div class="mb-3 w-full rounded bg-lime-100 border border-lime-400 text-lime-800 px-4 py-3">
            {{ session()->get('successMessage') }}
        </div>
    @endif

    <div class="card-table overflow-x-auto">
                <table class="min-w-full" role="table">
            <thead>
                <tr class="table-header">
                    <th class="px-5 py-3 text-left">#</th>
                    <th class="px-5 py-3 text-left">Image</th>
                    <th class="px-5 py-3 text-left">Name</th>
                    <th class="px-5 py-3 text-left">Slug</th>
                    <th class="px-5 py-3 text-left">Description</th>
                    <th class="px-5 py-3 text-left">Created</th>
                    <th class="px-5 py-3 text-left">On/Off</th>
                    <th class="px-5 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $key=>$category)
                <tr class="border-t" role="row">
                    <td class="px-5 py-4" data-label="#" role="cell">{{ $key+1 }}</td>
                    <td class="px-5 py-4" data-label="Image" role="cell">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="h-10 w-10 object-cover rounded">
                        @else
                            <div class="h-10 w-10 bg-gray-200 flex items-center justify-center rounded text-xs text-gray-500">N/A</div>
                        @endif
                    </td>
                    <td class="px-5 py-4 font-medium" data-label="Name" role="cell">{{ $category->name }}</td>
                    <td class="px-5 py-4" data-label="Slug" role="cell">
                        <span class="inline-block bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded">
                            {{ $category->slug }}
                        </span>
                    </td>
                    <td class="px-5 py-4 text-zinc-700 max-w-xs whitespace-pre-line break-words" data-label="Description" role="cell">
                        {{ $category->description }}
                    </td>
                    <td class="px-5 py-4 text-gray-500 text-sm" data-label="Created" role="cell">
                        {{ $category->created_at->format('d M Y') }}
                    </td>
                    <td class="px-5 py-4" data-label="On/Off" role="cell">
                        <form id="toggle-form-{{ $category->id }}" action="{{ route('categories.toggle', $category->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <label class="switch">
                                <input type="checkbox" onchange="this.form.submit()" {{ $category->is_active ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </form>
                    </td>
                    <td class="px-5 py-4" data-label="Actions" role="cell">
                        <flux:dropdown>
                            <flux:button icon:trailing="chevron-down" size="sm" class="btn-actions">Actions</flux:button>
                            <flux:menu>
                                <flux:menu.item icon="pencil" href="{{ route('categories.edit', $category->id) }}">Edit</flux:menu.item>
                                <flux:menu.item icon="trash" variant="danger" onclick="event.preventDefault(); if(confirm('Are you sure?')) document.getElementById('delete-form-{{ $category->id }}').submit();">Delete</flux:menu.item>
                                <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </flux:menu>
                        </flux:dropdown>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-4 text-center text-gray-500">No categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</x-layouts.app>
