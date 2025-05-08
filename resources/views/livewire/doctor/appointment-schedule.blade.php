{{-- <div class="p-4">
    <button wire:click="$set('showModal', true)" class="bg-blue-500 text-white px-4 py-2 rounded">Add Schedule</button>

    @if (session()->has('message'))
        <div class="mt-2 text-green-600">{{ session('message') }}</div>
    @endif

  <!-- Modal -->
@if ($showModal)
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded w-full max-w-md">
        <h2 class="text-lg font-bold mb-4">Add Available Date</h2>

        <!-- Doctor selection -->
        <label class="block mb-2">Select Doctor</label>
        <select wire:model="doctor_id" class="w-full border rounded px-2 py-1 mb-4">
            <option value="">-- Select Doctor --</option>
            @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
            @endforeach
        </select>
        @error('doctor_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <!-- Date input -->
        <label class="block mb-2">Available Date</label>
        <input type="date" wire:model="available_date" class="w-full border rounded px-2 py-1 mb-4">
        @error('available_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <div class="flex justify-end space-x-2">
            <button wire:click="saveAvailability" class="bg-green-500 text-white px-4 py-2 rounded">Save</button>
            <button wire:click="$set('showModal', false)" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
        </div>
    </div>
</div>
@endif


    <div class="mt-6">
        <h3 class="font-semibold mb-2">Doctor Available Dates</h3>
        <ul class="list-disc pl-6">
            @foreach($schedules as $schedule)
                <li>
                    {{ $schedule->available_date }} -
                    <strong>{{ $schedule->doctor->name ?? 'N/A' }}</strong>
                </li>
            @endforeach
        </ul>
    </div>

</div> --}}

<div class="p-4">
    <!-- Add Schedule Button -->
    <button wire:click="$set('showModal', true)" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Add Schedule
    </button>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="mt-2 text-green-600">{{ session('message') }}</div>
    @endif

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded w-full max-w-md shadow-lg">
                <h2 class="text-lg font-bold mb-4">Add Available Date</h2>

                <!-- Doctor selection -->
                <label class="block mb-2 font-medium">Select Doctor</label>
                <select wire:model="doctor_id" class="w-full border rounded px-2 py-1 mb-4">
                    <option value="">-- Select Doctor --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
                @error('doctor_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <!-- Date input -->
                <label class="block mb-2 font-medium">Available Date</label>
                <input type="date" wire:model="available_date" class="w-full border rounded px-2 py-1 mb-4">
                @error('available_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-2">
                    <button wire:click="saveAvailability" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
                    <button wire:click="$set('showModal', false)" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancel</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Schedule Table -->
    <div class="mt-6">
        <h3 class="text-lg font-semibold mb-4">Doctor Available Dates</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded shadow">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left border-b">#</th>
                        <th class="px-4 py-2 text-left border-b">Available Date</th>
                        <th class="px-4 py-2 text-left border-b">Doctor Name</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $index => $schedule)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($schedule->available_date)->format('F d, Y') }}</td>
                            <td class="px-4 py-2 border-b">{{ $schedule->doctor->name ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-3 text-center text-gray-500">No available dates scheduled.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
