<div>
    <!-- Button to Open Modal -->
    <div class="flex justify-end">
        <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded w-64">
            Add Pregnants Tracker
        </button>
    </div>

    <!-- Table to Display Tracker Data -->
    <div class="mt-6">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-200">

                        <th class="px-4 py-2 border">Date of Visit</th>
                        <th class="px-4 py-2 border">Family #</th>
                        <th class="px-4 py-2 border">Months Upon Visit</th>
                        <th class="px-4 py-2 border">Purok</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trackers as $tracker)
                        <tr>

                            <td class="border px-4 py-2 text-center">{{ $tracker->date_of_visit }}</td>
                            <td class="border px-4 py-2 text-center">{{ $tracker->family_number }}</td>
                            <td class="border px-4 py-2 text-center">{{ $tracker->months_upon_visit }}</td>
                            <td class="border px-4 py-2 text-center">{{ $tracker->purok }}</td>
                            <td class="border px-4 py-2 text-center">
                                <button wire:click="edit({{ $tracker->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                                <button wire:click="delete({{ $tracker->id }})" class="px-2 py-1 bg-red-500 text-white rounded" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form -->
    @if($showModal)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl max-h-[90vh] overflow-y-auto">
            <h2 class="text-2xl font-bold mb-4 text-blue-600">Add Pregnants Tracker</h2>

            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold">Date of Visit:</label>
                        <input type="date" wire:model="date_of_visit" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">Family #:</label>
                        <input type="text" wire:model="family_number" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">Months Upon Visit:</label>
                        <input type="number" wire:model="months_upon_visit" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">Purok:</label>
                        <input type="text" wire:model="purok" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">Vaccine Received:</label>
                        <input type="text" wire:model="vaccine_received" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">Weight (kg):</label>
                        <input type="number" wire:model="weight" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">Height (cm):</label>
                        <input type="number" wire:model="height" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">BP:</label>
                        <input type="text" wire:model="bp" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">Remarks:</label>
                        <input type="text" wire:model="remarks" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block font-semibold">Next Schedule Visit:</label>
                        <input type="date" wire:model="next_schedule_visit" class="w-full border p-2 rounded">
                    </div>
                </div>

                <div class="mt-4 flex gap-2 justify-end">
                    <button type="button" wire:click="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
