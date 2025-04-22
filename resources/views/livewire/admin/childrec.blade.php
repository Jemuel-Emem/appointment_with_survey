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
                        <td class="border px-4 py-2 text-center">{{ $child->name_of_child }}</td>
                        <td class="border px-4 py-2 text-center">{{ $child->date_of_delivery }}</td>
                        <td class="border px-4 py-2 text-center">{{ $child->sex_of_baby }}</td>
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
                    <p><strong>Name of Child:</strong> {{ $selectedChild->name_of_child }}</p>
                    <p><strong>Date of Delivery:</strong> {{ $selectedChild->date_of_delivery }}</p>
                    <p><strong>Sex:</strong> {{ $selectedChild->sex_of_baby }}</p>
                    <p><strong>Weight:</strong> {{ $selectedChild->weight }} kg</p>
                    <p><strong>Mother's Name:</strong> {{ $selectedChild->name_of_mother }}</p>
                </div>
                <div>
                    <p><strong>Place of Delivery:</strong> {{ $selectedChild->place_of_delivery }}</p>
                    <p><strong>Type of Delivery:</strong> {{ $selectedChild->type_of_delivery }}</p>
                    <p><strong>Remarks:</strong> {{ $selectedChild->remarks }}</p>
                    <p><strong>Vaccine Info:</strong> {{ $selectedChild->date_and_vaccine_given }}</p>
                </div>
            </div>


            <div class="mt-6 flex justify-end">
                <button wire:click="closeModal" class="px-6 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Close</button>
            </div>
        </div>
    </div>
    @endif
</div>
