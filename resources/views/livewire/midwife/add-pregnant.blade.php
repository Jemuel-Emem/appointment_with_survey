<div>
    <div class="flex justify-end">
       {{-- // <a href="{{ route('midwifepregnats-tracker') }}" class="text-green-500 underline">Pregnants Tracker</a> --}}
        <!-- Add Pregnant Button -->
        <button wire:click="openModal('pregnant')" class="bg-blue-500 text-white px-4 py-2 rounded w-64">
            Add Pregnant
        </button>
    </div>

    <div class="mt-6">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 border">Complete Name</th>
                        <th class="px-4 py-2 border">Age</th>
                        <th class="px-4 py-2 border">Purok</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pregnantRecords as $record)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $record->name }}</td>
                            <td class="border px-4 py-2 text-center">{{ $record->age }}</td>
                            <td class="border px-4 py-2 text-center">{{ $record->purok }}</td>
                            <td class="border px-4 py-2 text-center">
                                <button wire:click="showDetails({{ $record->id }})"
                                    class="px-2 py-1 bg-gray-500 text-white rounded">
                                    Show Details
                                </button>

                                <button wire:click="edit({{ $record->id }}, 'pregnant')"
                                    class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>


                                <button wire:click="openModal('tracker', {{ $record->id }})"
                                    class="px-2 py-1 bg-blue-500 text-white rounded">Tracker
                            </button>

                            <button
                            onclick="confirm('Are you sure you want to delete this?') || event.stopImmediatePropagation()"
                            wire:click="delete({{ $record->id }})"
                            class="px-2 py-1 bg-red-500 text-white rounded">
                            Delete
                        </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Unified Modal -->
    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-4">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl max-h-[90vh] overflow-y-auto">
                <h2 class="text-2xl font-bold mb-4 text-blue-600">
                    {{ $modalType === 'pregnant' ? 'Add Pregnant Record' : 'Add Pregnant Tracker' }}
                </h2>

                <!-- Form -->
                <form wire:submit.prevent="save">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if($modalType === 'pregnant')
                            <div>
                                <label class="block font-semibold">Date Tracked:</label>
                                <input type="date" wire:model="date_tracked" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">Complete Name:</label>
                                <input type="text" wire:model="name" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">Date of Birth (Due Date):</label>
                                <input type="date" wire:model="dob" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">Age:</label>
                                <input type="number" wire:model="age" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">GP:</label>
                                <input type="text" wire:model="gp" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">Height (cm):</label>
                                <input type="number" wire:model="height" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">Weight (kg):</label>
                                <input type="number" wire:model="weight" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">BMI:</label>
                                <input type="number" wire:model="bmi" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">Pregnant Tracked (months):</label>
                                <input type="number" wire:model="pregnant_months" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">Purok:</label>
                                <input type="text" wire:model="purok" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">Husband/Partner:</label>
                                <input type="text" wire:model="husband_partner" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">MUAC:</label>
                                <input type="text" wire:model="muac" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">TT Status:</label>
                                <input type="text" wire:model="tt_status" class="w-full border p-2 rounded">
                            </div>

                               <div>
                                        <label class="block font-semibold">Phone Number:</label>
                                        <input type="text" wire:model="phone_number" class="w-full border p-2 rounded">
                        </div>

       <!-- In the pregnant form section -->
<div class="col-span-2 flex items-center space-x-2 mt-4">
    <input type="checkbox" wire:model="is_follow_up" id="is_follow_up" class="w-4 h-4">
    <label for="is_follow_up">Schedule for Checkup</label>
</div>
                        @else
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
                                <input type="text" wire:model="purok1" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">Vaccine Received:</label>
                                <input type="text" wire:model="vaccine_received" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">Weight (kg):</label>
                                <input type="number" wire:model="weight1" class="w-full border p-2 rounded">
                            </div>
                            <div>
                                <label class="block font-semibold">Height (cm):</label>
                                <input type="number" wire:model="height1" class="w-full border p-2 rounded">
                            </div>


                            <div>
                                <label class="block font-semibold">BP:</label>
                                <input type="text" wire:model="bp" class="w-full border p-2 rounded">
                            </div>


                            <div>
                                <label class="block font-semibold">Next Schedule Visit:</label>
                                <input type="date" wire:model="next_schedule_visit" class="form-input w-full border p-2 rounded" />
                            </div>

                            <div>
                                <label class="block font-semibold">Remarks:</label>
                                <textarea wire:model="remarks1" class="form-input w-full border p-2 rounded"></textarea>
                            </div>


                            <div class="col-span-2">
                                <h3 class="font-semibold text-lg mb-2">Tracker History</h3>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-gray-100 border">
                                        <thead>
                                            <tr class="bg-gray-300">
                                                <th class="px-4 py-2 border">Date of Visit</th>
                                                <th class="px-4 py-2 border">Family #</th>
                                                <th class="px-4 py-2 border">Months Upon Visit</th>
                                                <th class="px-4 py-2 border">Purok</th>
                                                <th class="px-4 py-2 border">Vaccine Received</th>
                                                <th class="px-4 py-2 border">Weight (kg)</th>
                                                <th class="px-4 py-2 border">Height (cm)</th>
                                                <th class="px-4 py-2 border">BP</th>
                                                <th class="px-4 py-2 border">Next Schedule Visit</th>
                                                <th class="px-4 py-2 border">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($trackerRecords as $tracker)
                                                <tr>
                                                    <td class="border px-4 py-2 text-center">{{ $tracker->date_of_visit }}</td>
                                                    <td class="border px-4 py-2 text-center">{{ $tracker->family_number }}</td>
                                                    <td class="border px-4 py-2 text-center">{{ $tracker->months_upon_visit }}</td>
                                                    <td class="border px-4 py-2 text-center">{{ $tracker->purok }}</td>
                                                    <td class="border px-4 py-2 text-center">{{ $tracker->vaccine_received }}</td>
                                                    <td class="border px-4 py-2 text-center">{{ $tracker->weight }}</td>
                                                    <td class="border px-4 py-2 text-center">{{ $tracker->height }}</td>
                                                    <td class="border px-4 py-2 text-center">{{ $tracker->bp }}</td>
                                                    <td class="border px-4 py-2 text-center">{{ $tracker->next_schedule_visit }}</td>
                                                    <td class="border px-4 py-2 text-center">{{ $tracker->remarks }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10" class="border px-4 py-2 text-center text-gray-500">
                                                        No tracker records available for this pregnant individual.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Buttons -->
                    <div class="mt-4 flex gap-2 justify-end">
                        <button type="button" wire:click="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if($showDetailsModal)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-4 z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <h2 class="text-2xl font-bold mb-4 text-gray-600">Pregnant Record Details</h2>

            @if($detailRecord)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div><strong>Date Tracked:</strong> {{ $detailRecord->date_tracked }}</div>
                    <div><strong>Complete Name:</strong> {{ $detailRecord->name }}</div>
                    <div><strong>Due Date (DOB):</strong> {{ $detailRecord->dob }}</div>
                    <div><strong>Age:</strong> {{ $detailRecord->age }}</div>
                    <div><strong>GP:</strong> {{ $detailRecord->gp }}</div>
                    <div><strong>Height:</strong> {{ $detailRecord->height }} cm</div>
                    <div><strong>Weight:</strong> {{ $detailRecord->weight }} kg</div>
                    <div><strong>BMI:</strong> {{ $detailRecord->bmi }}</div>
                    <div><strong>Pregnant Months:</strong> {{ $detailRecord->pregnant_months }}</div>
                    <div><strong>Purok:</strong> {{ $detailRecord->purok }}</div>
                    <div><strong>Husband/Partner:</strong> {{ $detailRecord->husband_partner }}</div>
                    <div><strong>MUAC:</strong> {{ $detailRecord->muac }}</div>
                    <div><strong>TT Status:</strong> {{ $detailRecord->tt_status }}</div>
                     <div><strong>Phone Number:</strong> {{ $detailRecord->phone_number }}</div>
                    <div class="col-span-2"><strong>Remarks:</strong> {{ $detailRecord->remarks }}</div>
                </div>
            @endif

            <div class="mt-4 flex justify-end">
                <button wire:click="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded">Close</button>
            </div>
        </div>
    </div>
@endif

</div>
