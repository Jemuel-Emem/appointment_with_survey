<div>
   <div class="flex justify-end">
    <a href="{{route('admin.med_appointments')}}" class="text-blue-500 "> <button>Midwife Appointments</button></a>
   </div>
    <h2 class="text-2xl font-bold mb-4">Appointments</h2>

    <table class="min-w-full bg-white border">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">Patient</th>
                <th class="px-4 py-2 border">Date</th>
                <th class="px-4 py-2 border">Time</th>
                <th class="px-4 py-2 border">Doctor</th>
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
                        {{ $appointment->doctor ? $appointment->doctor->name : 'N/A' }}
                    </td>
                    <td class="border px-4 py-2 text-center">
                        <button wire:click="openFollowupModal({{ $appointment->id }})" class="px-2 py-1 bg-green-500 text-white rounded">View More</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($showFollowupModal)
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-4">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
                <h2 class="text-2xl font-bold mb-4">Follow-up Appointments</h2>

                @if(count($followups) > 0)
                    <table class="min-w-full bg-white border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 border">Follow-up Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($followups as $followup)
                                <tr>
                                    <td class="border px-4 py-2 text-center">{{ $followup->followup_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-gray-500">No follow-up appointments found.</p>
                @endif

                <div class="mt-4 flex justify-end">
                    <button wire:click="closeFollowupModal" class="bg-gray-400 text-white px-4 py-2 rounded">Close</button>
                </div>
            </div>
        </div>
    @endif
</div>
