<x-layouts.app :title="__('Categories')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Update Product Categories</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Product Categories</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('successMessage'))
        <div class="mb-3 w-full rounded bg-lime-100 border border-lime-400 text-lime-800 px-4 py-3">
            {{ session()->get('successMessage') }}
        </div>
    @elseif(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 wf-full">{{session()->get('errorMessage')}}</flux:badge>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        
        <flux:input label="Name" name="name" value="{{ $category->name }}" class="mb-3" />

        <flux:input label="Slug" name="slug" value="{{ $category->slug }}" class="mb-3" />

        <flux:textarea label="Description" name="description" class="mb-3">{{ $category->description }}</flux:textarea>

        @if($category->image)
            <div class="mb-3">
                <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-32 h-32 object-cover rounded">
            </div>
        @endif

        <flux:input type="file" label="Image" name="image" class="mb-3" />

        <flux:checkbox label="Active" name="is_active" class="mb-3" :checked="$category->is_active" />

        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Update</flux:button>
            <flux:link href="{{ route('categories.index') }}" variant="ghost" class="ml-3">Kembali</flux:link>
        </div>
    </form>
</x-layouts.app>
