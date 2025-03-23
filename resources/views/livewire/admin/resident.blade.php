<div>
    <div class="flex justify-end">
        <!-- Button to open modal -->
        <button wire:click="$set('showModal', true)" class="px-4 py-2 bg-blue-500 text-white rounded w-64">
            Add Resident
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">Houseold ID</th>
                    <th class="px-4 py-2 border">Full Name</th>
                    <th class="px-4 py-2 border">Age</th>
                    <th class="px-4 py-2 border">Gender</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($residents as $resident)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $resident->household_id }}</td>
                        <td class="border px-4 py-2 text-center">{{ $resident->full_name }}</td>
                        <td class="border px-4 py-2 text-center">{{ $resident->age }}</td>
                        <td class="border px-4 py-2 text-center">{{ $resident->gender }}</td>
                        <td class="border px-4 py-2 text-center">
                            <button wire:click="showResident({{ $resident->id }})" class="px-2 py-1 bg-blue-500 text-white rounded">Show Details</button>
                            <button wire:click="editResident({{ $resident->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <button wire:click="deleteResident({{ $resident->id }})" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-3/4 max-h-[90vh] overflow-y-auto relative">
                <button wire:click="closeModal" class="absolute top-2 right-2 px-3 py-1 bg-red-500 text-white rounded-full">
                    &times;
                </button>
                <h2 class="text-lg font-bold mb-4">Add Resident</h2>

                <form wire:submit.prevent="save">
                    <div class="grid grid-cols-3 gap-4">
                        <!-- Household ID -->
                        <div class="col-span-3">
                            <label class="block text-sm font-medium">Household ID #</label>
                            <input type="text" wire:model="household_id" class="w-full border rounded p-2">
                            @error('household_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Personal Information -->
                        <div class="col-span-3 font-bold text-lg">Personal Information</div>
                        <div>
                            <label class="block text-sm font-medium">Full Name</label>
                            <input type="text" wire:model="full_name" class="w-full border rounded p-2">
                            @error('full_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Date of Birth</label>
                            <input type="date" wire:model="date_of_birth" class="w-full border rounded p-2">
                            @error('date_of_birth') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Age</label>
                            <input type="number" wire:model="age" class="w-full border rounded p-2">
                            @error('age') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Gender</label>
                            <select wire:model="gender" class="w-full border rounded p-2">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            @error('gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Civil Status</label>
                            <input type="text" wire:model="civil_status" class="w-full border rounded p-2">
                            @error('civil_status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Purok/Zone -->
<div>
    <label class="block text-sm font-medium">Purok/Zone</label>
    <input type="text" wire:model="purok_zone" class="w-full border rounded p-2">
    @error('purok_zone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
</div>

<!-- Years of Residency -->
<div>
    <label class="block text-sm font-medium">Years of Residency</label>
    <input type="number" wire:model="years_of_residency" class="w-full border rounded p-2">
    @error('years_of_residency') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
</div>

                        <div>
                            <label class="block text-sm font-medium">Contact Number</label>
                            <input type="text" wire:model="contact_number" class="w-full border rounded p-2">
                            @error('contact_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Email Address</label>
                            <input type="email" wire:model="email" class="w-full border rounded p-2">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Home Address</label>
                            <input type="text" wire:model="home_address" class="w-full border rounded p-2">
                            @error('home_address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Emergency Contact -->
                        <div class="col-span-3 font-bold text-lg">Emergency Contact</div>
                        <div>
                            <label class="block text-sm font-medium">Name</label>
                            <input type="text" wire:model="emergency_name" class="w-full border rounded p-2">
                            @error('emergency_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Relationship</label>
                            <input type="text" wire:model="emergency_relationship" class="w-full border rounded p-2">
                            @error('emergency_relationship') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Contact Number</label>
                            <input type="text" wire:model="emergency_contact_number" class="w-full border rounded p-2">
                            @error('emergency_contact_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-3">
                            <label class="block text-sm font-medium">Alternate Contact Number</label>
                            <input type="text" wire:model="emergency_alt_contact_number" class="w-full border rounded p-2">
                            @error('emergency_alt_contact_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded">Close</button>
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    @endif


    @if($viewAllModal && $selectedResident)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-3/4 max-h-[90vh] overflow-y-auto">
                <h2 class="text-2xl font-bold mb-4 text-center">Resident Details</h2>

                <div class="grid grid-cols-2 gap-6">
                    <!-- Column 1 -->
                    <div>
                        <h3 class="text-lg font-semibold border-b pb-2">Personal Information</h3>
                        <p><strong>Household ID:</strong> {{ $selectedResident->household_id }}</p>
                        <p><strong>Full Name:</strong> {{ $selectedResident->full_name }}</p>
                        <p><strong>Date of Birth:</strong> {{ $selectedResident->date_of_birth }}</p>
                        <p><strong>Age:</strong> {{ $selectedResident->age }}</p>
                        <p><strong>Gender:</strong> {{ $selectedResident->gender }}</p>
                        <p><strong>Civil Status:</strong> {{ $selectedResident->civil_status }}</p>
                        <p><strong>Contact Number:</strong> {{ $selectedResident->contact_number }}</p>
                        <p><strong>Email:</strong> {{ $selectedResident->email }}</p>
                        <p><strong>Home Address:</strong> {{ $selectedResident->home_address }}</p>
                        <p><strong>Purok/Zone:</strong> {{ $selectedResident->purok_zone }}</p>
                        <p><strong>Years of Residency:</strong> {{ $selectedResident->years_of_residency }}</p>
                    </div>

                    <!-- Column 2 -->
                    <div>
                        <h3 class="text-lg font-semibold border-b pb-2">Emergency Contact</h3>
                        <p><strong>Contact Name:</strong> {{ $selectedResident->emergency_contact_name }}</p>
                        <p><strong>Relationship:</strong> {{ $selectedResident->emergency_contact_relationship }}</p>
                        <p><strong>Contact Number:</strong> {{ $selectedResident->emergency_contact_number }}</p>
                        <p><strong>Alternate Contact Number:</strong> {{ $selectedResident->emergency_alt_contact_number }}</p>


                    </div>

                </div>

                <div class="mt-6 flex justify-end">
                    <button wire:click="closeModal1" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
