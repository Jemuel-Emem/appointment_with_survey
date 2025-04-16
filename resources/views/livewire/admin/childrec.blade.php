<div>
    <div class="overflow-x-auto">
        <table class="min-w-full ">
            <thead>
                <tr class="">
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Full Name</th>
                    <th class="px-4 py-2 border">Birthdate</th>
                    <th class="px-4 py-2 border">Gender</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($newborns as $child)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $child->id }}</td>
                        <td class="border px-4 py-2 text-center">{{ $child->full_name }}</td>
                        <td class="border px-4 py-2 text-center">{{ $child->birth_date }}</td>
                        <td class="border px-4 py-2 text-center">{{ $child->gender }}</td>
                        <td class="border px-4 py-2 text-center">
                            <button wire:click="showChild({{ $child->id }})" class="px-2 py-1 bg-blue-500 text-white rounded">Show Details</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($showModal && $selectedChild)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg w-3/4 max-h-[90vh] overflow-y-auto">
            <h2 class="text-2xl font-bold mb-4 text-center">Child Details</h2>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p><strong>Full Name:</strong> {{ $selectedChild->full_name }}</p>
                    <p><strong>Birth Date:</strong> {{ $selectedChild->birth_date }}</p>
                    <p><strong>Gender:</strong> {{ $selectedChild->gender }}</p>
                    <p><strong>Birth Weight:</strong> {{ $selectedChild->birth_weight }}</p>
                    <p><strong>Mother's Name:</strong> {{ $selectedChild->mother_name }}</p>
                    <p><strong>Father's Name:</strong> {{ $selectedChild->father_name }}</p>
                </div>
                <div>
                    <p><strong>Birth Place:</strong> {{ $selectedChild->birth_place }}</p>
                    <p><strong>Attending Physician:</strong> {{ $selectedChild->attending_physician }}</p>
                    <p><strong>Health Notes:</strong> {{ $selectedChild->health_notes }}</p>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button wire:click="closeModal" class="px-6 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Close</button>
            </div>
        </div>
    </div>
    @endif
</div>
