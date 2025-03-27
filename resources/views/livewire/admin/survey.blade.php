<div>
   <div class="flex justify-end">
    <button class="px-4 py-2 bg-blue-500 text-white rounded" wire:click="openModal">Add Survey</button>
   </div>

    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Title</th>
                <th class="border p-2">Description</th>
                <th class="border p-2">Form Link</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surveys as $survey)
                <tr>
                    <td class="border p-2 text-center">{{ $survey->title }}</td>
                    <td class="border p-2 text-center">{{ $survey->description }}</td>
                    <td class="border p-2 text-center">
                        <a href="{{ $survey->form_link }}" target="_blank" class="text-blue-500 underline">View Form</a>
                    </td>
                    <td class="border p-2 space-x-2 text-center">
                        <button class="px-2 py-1 bg-yellow-500 text-white rounded" wire:click="edit({{ $survey->id }})">Edit</button>
                        <button class="px-2 py-1 bg-red-500 text-white rounded" wire:click="delete({{ $survey->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-1/2">
                <h2 class="text-lg font-bold mb-4">{{ $survey_id ? 'Edit' : 'Add' }} Survey</h2>
                <form wire:submit.prevent="save">
                    <div>
                        <label class="block text-sm font-medium">Title</label>
                        <input type="text" wire:model="title" class="w-full border rounded p-2">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Description</label>
                        <textarea wire:model="description" class="w-full border rounded p-2"></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Form Link</label>
                        <input type="text" wire:model="form_link" class="w-full border rounded p-2">
                        @error('form_link') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded">Close</button>
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
