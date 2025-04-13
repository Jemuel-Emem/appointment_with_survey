<div>
    <div class="flex justify-end">
        <button wire:click="openModal" class="mb-4 bg-blue-500 text-white px-4 py-2 rounded">Add Appointment</button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">Pregnant Name</th>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Time</th>


                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $appointment->patient_name }}</td>
                        <td class="border px-4 py-2 text-center">{{ $appointment->appointment_date }}</td>
                        <td class="border px-4 py-2 text-center">{{ $appointment->appointment_time }}</td>


                        <td class="border px-4 py-2 text-center">
                            <button wire:click="editAppointment({{ $appointment->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>

                            <button wire:click="openFollowupModal({{ $appointment->id }})" class="px-2 py-1 bg-green-500 text-white rounded">Follow-up</button>
                            <button
                            onclick="confirm('Are you sure you want to delete this survey?') || event.stopImmediatePropagation()"
                            wire:click="deleteAppointment({{ $appointment->id }})"
                            class="px-2 py-1 bg-red-500 text-white rounded">
                            Delete
                        </button>

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($showFollowupModal)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">


            <h2 class="text-2xl font-bold mb-4">Schedule Follow-up</h2>
            <form wire:submit.prevent="saveFollowup">
                <div>
                    <label class="block font-semibold">Follow-up Date:</label>
                    <input type="date" wire:model="followupDate" class="w-full border p-2 rounded">
                </div>

                <div class="mt-4 flex gap-2">
                    <button type="button" wire:click="$set('showFollowupModal', false)" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>

            <h3 class="text-xl font-semibold mt-4">Follow-up History</h3>
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 border">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Midwife_FollowAppointement::where('med_id', $appointmentId)->get() as $followup)


                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $followup->followup_date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @if($showModal)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
            @error('time') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            <h2 class="text-2xl font-bold mb-4">{{ $isEditing ? 'Edit' : 'Add' }} Appointment</h2>
            <form wire:submit.prevent="save">
                <div>
                    <label class="block font-semibold">Pregnant Name:</label>
                    <input type="text" wire:model="patientName" class="w-full border p-2 rounded">
                </div>

                <div class="mt-2">
                    <label class="block font-semibold">Date:</label>
                    <input type="date" wire:model="date" class="w-full border p-2 rounded">
                </div>

                <div class="mt-2">
                    <label class="block font-semibold">Time:</label>
                    <input type="time" wire:model="time" class="w-full border p-2 rounded">
                </div>



                <div class="mt-4 flex gap-2">
                    <button type="button" wire:click="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
