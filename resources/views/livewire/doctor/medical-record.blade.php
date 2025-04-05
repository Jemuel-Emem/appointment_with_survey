<div>
    <div class="flex justify-end mb-4">
        <button wire:click="$set('showModal', true)" class="px-4 py-2 bg-blue-500 text-white rounded w-64">
            Add Medical Record
        </button>
    </div>
    <div class="overflow-x-auto bg-white shadow rounded-lg p-4 mb-6">
        <h3 class="text-lg font-semibold mb-2">Medical Records</h3>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Full Name</th>
                    <th class="px-4 py-2 text-left">Diagnosis</th>
                    <th class="px-4 py-2 text-left">Symptoms</th>
                    <th class="px-4 py-2 text-left">Prescriptions</th>
                    <th class="px-4 py-2 text-left">Date</th>

                    <th class="px-4 py-2 text-left">Action</th>

                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($medicalRecords as $record)
                    <tr>
                        <td class="px-4 py-2">{{ $record->full_name }}</td>
                        <td class="px-4 py-2">{{ $record->diagnosis }}</td>
                        <td class="px-4 py-2">{{ $record->symptoms }}</td>
                        <td class="px-4 py-2">{{ $record->prescriptions }}</td>
                        <td class="px-4 py-2">{{ $record->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-2">
                            <button wire:click="viewRecord({{ $record->id }})" class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                                Show More Details
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-gray-500">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($showViewModal && $selectedRecord)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-2xl overflow-y-auto max-h-[90vh]">
            <h2 class="text-xl font-bold mb-4">Medical Record Details</h2>

            <div class="grid grid-cols-2 gap-4">
                <div><strong>Full Name:</strong> {{ $selectedRecord->full_name }}</div>
                <div><strong>Date of Birth:</strong> {{ $selectedRecord->date_of_birth }}</div>
                <div><strong>Age:</strong> {{ $selectedRecord->age }}</div>
                <div><strong>Gender:</strong> {{ $selectedRecord->gender }}</div>
                <div><strong>Civil Status:</strong> {{ $selectedRecord->civil_status }}</div>
                <div><strong>Contact Number:</strong> {{ $selectedRecord->contact_number }}</div>
                <div><strong>Email:</strong> {{ $selectedRecord->email }}</div>
                <div class="col-span-2"><strong>Address:</strong> {{ $selectedRecord->home_address }}</div>
                <div><strong>Purok/Zone:</strong> {{ $selectedRecord->purok_zone }}</div>
                <div><strong>Years of Residency:</strong> {{ $selectedRecord->years_of_residency }}</div>
                <div class="col-span-2"><strong>Diagnosis:</strong> {{ $selectedRecord->diagnosis }}</div>
                <div class="col-span-2"><strong>Symptoms:</strong> {{ $selectedRecord->symptoms }}</div>
                <div class="col-span-2"><strong>Prescriptions:</strong> {{ $selectedRecord->prescriptions }}</div>
            </div>

            <div class="flex justify-end mt-6">
                <button wire:click="$set('showViewModal', false)" class="px-4 py-2 bg-gray-500 text-white rounded">
                    Close
                </button>
            </div>
        </div>
    </div>
@endif

    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-2xl overflow-y-auto max-h-[90vh]"  wire:key="{{ now() }}">
                @if (session()->has('error'))
                    <div class="text-red-500 mt-2">
                        {{ session('error') }}
                    </div>
                @endif

                <h2 class="text-xl font-bold mb-4">Add Medical Record</h2>

                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block mb-1">Household ID</label>
                        <div class="flex space-x-2">
                            <input type="text" wire:model="household_id" class="flex-1 border rounded px-2 py-1">
                            <button wire:click="fetchPatientData"
                                    wire:loading.attr="disabled"
                                    class="px-3 py-1 bg-indigo-600 text-white rounded">
                                <span wire:loading.remove>Show Patient</span>
                                <span wire:loading>Loading...</span>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label>Full Name</label>
                        <input type="text" wire:model="full_name" class="w-full border rounded px-2 py-1" readonly>
                    </div>
                    <div>
                        <label>Date of Birth</label>
                        <input type="date" wire:model="date_of_birth" class="w-full border rounded px-2 py-1" readonly>
                    </div>
                    <div>
                        <label>Age</label>
                        <input type="number" wire:model="age" class="w-full border rounded px-2 py-1" readonly>
                    </div>
                    <div>
                        <label>Gender</label>
                        <select wire:model="gender" class="w-full border rounded px-2 py-1" disabled>
                            <option value="">Select</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                    <div>
                        <label>Civil Status</label>
                        <input type="text" wire:model="civil_status" class="w-full border rounded px-2 py-1" readonly>
                    </div>
                    <div>
                        <label>Contact Number</label>
                        <input type="text" wire:model="contact_number" class="w-full border rounded px-2 py-1" readonly>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" wire:model="email" class="w-full border rounded px-2 py-1" readonly>
                    </div>

                    <div class="col-span-2">
                        <label>Home Address</label>
                        <input type="text" wire:model="home_address" class="w-full border rounded px-2 py-1" readonly>
                    </div>
                    <div>
                        <label>Purok/Zone</label>
                        <input type="text" wire:model="purok_zone" class="w-full border rounded px-2 py-1" readonly>
                    </div>
                    <div>
                        <label>Years of Residency</label>
                        <input type="number" wire:model="years_of_residency" class="w-full border rounded px-2 py-1" readonly>
                    </div>

                    <div class="col-span-2">
                        <label>Diagnosis</label>
                        <textarea wire:model="diagnosis" class="w-full border rounded px-2 py-1"></textarea>
                    </div>
                    <div class="col-span-2">
                        <label>Symptoms</label>
                        <textarea wire:model="symptoms" class="w-full border rounded px-2 py-1"></textarea>
                    </div>
                    <div class="col-span-2">
                        <label>Prescriptions</label>
                        <textarea wire:model="prescriptions" class="w-full border rounded px-2 py-1"></textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-6 space-x-2">
                    <button wire:click="save" class="px-4 py-2 bg-green-500 text-white rounded">Save</button>
                    <button wire:click="$set('showModal', false)" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                </div>
            </div>
        </div>
    @endif
</div>
