<div>

  <div class="flex justify-end">
    <button wire:click="openModal" class="px-4 py-2 bg-blue-600 text-white rounded">Add Newborn</button>
  </div>


    @if (session()->has('message'))
        <div class="p-2 mt-2 text-green-600 bg-green-100">
            {{ session('message') }}
        </div>
    @endif

    <!-- Newborn Records Table -->
    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Name of Child</th>
                <th class="border px-4 py-2">Sex</th>
                <th class="border px-4 py-2">Date of Delivery</th>
                <th class="border px-4 py-2">Weight (kg)</th>
                <th class="border px-4 py-2">Length (cm)</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($newborns as $newborn)
                <tr>
                    <td class="border px-4 py-2 text-center">{{ $newborn->name_of_child }}</td>
                    <td class="border px-4 py-2 text-center">{{ $newborn->sex_of_baby }}</td>
                    <td class="border px-4 py-2 text-center">{{ $newborn->date_of_delivery }}</td>
                    <td class="border px-4 py-2 text-center">{{ $newborn->weight }}</td>
                    <td class="border px-4 py-2 text-center">{{ $newborn->length }}</td>
                    <td class="border px-4 py-2 text-center">
                        <button wire:click="editNewborn({{ $newborn->id }})" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</button>

                        <button wire:click="openTracker({{ $newborn->id }})" class="px-3 py-1 bg-blue-500 text-white rounded">Tracker</button>
                        <button
                        onclick="confirm('Are you sure you want to delete this?') || event.stopImmediatePropagation()"
                        wire:click="confirmDelete({{ $newborn->id }})"
                        class="px-2 py-1 bg-red-500 text-white rounded">
                        Delete
                    </button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    @if($isTrackerOpen)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-2/3">
            <h2 class="text-lg font-bold mb-4">Newborn Tracker for {{ $newbornName }}</h2>

            <!-- Tracker Records Table -->


            <!-- Form to Add Tracker Entry -->
            <form wire:submit.prevent="saveVisit" class="mt-4">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Visit Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Visit Date</label>
                        <input type="date" wire:model="visit_date" class="w-full border p-2 rounded">
                        @error('visit_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Age Today -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Age Today</label>
                        <input type="number" wire:model="age_today" class="w-full border p-2 rounded">
                        @error('age_today') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <!-- Height -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Height (cm)</label>
                        <input type="number" step="0.01" wire:model="height" class="w-full border p-2 rounded">
                        @error('height') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Reason of Visit -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Reason for Visit</label>
                        <input type="text" wire:model="reason_of_visit" class="w-full border p-2 rounded">
                        @error('reason_of_visit') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <!-- Vaccine or Service Provided -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Vaccine/Service Provided</label>
                        <input type="text" wire:model="vaccine_or_service_provided" class="w-full border p-2 rounded">
                        @error('vaccine_or_service_provided') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Dose -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dose</label>
                        <input type="text" wire:model="dose" class="w-full border p-2 rounded">
                        @error('dose') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <!-- Schedule Next Visit -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Schedule Next Visit</label>
                        <input type="date" wire:model="schedule_next_visit" class="w-full border p-2 rounded">
                        @error('schedule_next_visit') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Remarks -->
                 <div>
                        <label class="block text-sm font-medium text-gray-700">Remarks</label>
                        <textarea wire:model="remarks" class="w-full border p-2 rounded"></textarea>
                        @error('remarks') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>


                </div>

                <div class="mt-4 mb-4 flex justify-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Save Visit</button>
                    <button type="button" wire:click="closeTracker" class="px-4 py-2 bg-gray-400 text-white rounded">Close</button>
                </div>
            </form>


            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">Visit Date</th>
                        <th class="border px-4 py-2">Age</th>
                        <th class="border px-4 py-2">Height (cm)</th>
                        <th class="border px-4 py-2">Reason</th>
                        <th class="border px-4 py-2">Vaccine/Service</th>
                        <th class="border px-4 py-2">Dose</th>
                        <th class="border px-4 py-2">Next Visit</th>
                        <th class="border px-4 py-2">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visits as $visit)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $visit->visit_date }}</td>
                            <td class="border px-4 py-2 text-center">{{ $visit->age_today }}</td>
                            <td class="border px-4 py-2 text-center">{{ $visit->height }}</td>
                            <td class="border px-4 py-2 text-center">{{ $visit->reason_of_visit }}</td>
                            <td class="border px-4 py-2 text-center">{{ $visit->vaccine_or_service_provided }}</td>
                            <td class="border px-4 py-2 text-center">{{ $visit->dose }}</td>
                            <td class="border px-4 py-2 text-center">{{ $visit->schedule_next_visit }}</td>
                            <td class="border px-4 py-2 text-center">{{ $visit->remarks }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <!-- Modal -->
    @if($isModalOpen)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-1/2">
            <h2 class="text-lg font-bold mb-4">{{ $editMode ? 'Edit Newborn' : 'Add Newborn' }}</h2>

            <!-- Form -->
            <form wire:submit.prevent="{{ $editMode ? 'updateNewborn' : 'saveNewborn' }}">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label>Date of Delivery</label>
                        <input type="date" wire:model="date_of_delivery" class="w-full border p-2">
                        @error('date_of_delivery') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label>Time of Delivery</label>
                        <input type="time" wire:model="time_of_delivery" class="w-full border p-2">
                        @error('time_of_delivery') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label>Name of Mother</label>
                        <input type="text" wire:model="name_of_mother" class="w-full border p-2">
                        @error('name_of_mother') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label>Age</label>
                        <input type="number" wire:model="age" class="w-full border p-2">
                        @error('age') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label>Sex of Baby</label>
                        <select wire:model="sex_of_baby" class="w-full border p-2">
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('sex_of_baby') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label>Name of Child</label>
                        <input type="text" wire:model="name_of_child" class="w-full border p-2">
                        @error('name_of_child') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label>Length (cm)</label>
                        <input type="number" step="0.01" wire:model="length" class="w-full border p-2">
                        @error('length') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label>Weight (kg)</label>
                        <input type="number" step="0.01" wire:model="weight" class="w-full border p-2">
                        @error('weight') <span class="text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-2">
                        <label>Date and Vaccine Given</label>
                        <textarea wire:model="date_and_vaccine_given" class="w-full border p-2"></textarea>
                    </div>

                    <div>
                        <label>Place of Delivery</label>
                        <input type="text" wire:model="place_of_delivery" class="w-full border p-2">
                    </div>

                    <div>
                        <label>Type of Delivery</label>
                        <select wire:model="type_of_delivery" class="w-full border p-2">
                            <option value="">Select</option>
                            <option value="Normal">Normal</option>
                            <option value="C-Section">C-Section</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label>Remarks</label>
                        <textarea wire:model="remarks1" class="w-full border p-2"></textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
                    <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @endif

</div>
