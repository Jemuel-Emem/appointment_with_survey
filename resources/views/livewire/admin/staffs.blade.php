<div>
<div class="flex justify-end">
        <!-- Button to Open Modal -->
        <button wire:click="openModal" class="mb-4 bg-blue-500 text-white px-4 py-2 rounded w-64">
            Add Staff
        </button>
</div>

    <!-- Staff Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border">
            <thead>
                <tr class="bg-gray-200">

                    <th class="px-4 py-2 border">Full Name</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Role</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffs as $staff)
                    <tr>

                        <td class="border px-4 py-2 text-center">{{ $staff->name }}</td>
                        <td class="border px-4 py-2 text-center">{{ $staff->email }}</td>
                        <td class="border px-4 py-2 text-center">
                            {{ $staff->is_admin == 2 ? 'Doctor' : 'Midwife' }}
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <button wire:click="editStaff({{ $staff->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <button
                            onclick="confirm('Are you sure you want to delete this staff?') || event.stopImmediatePropagation()"
                            wire:click="deleteStaff({{ $staff->id }})"
                            class="px-2 py-1 bg-red-500 text-white rounded">
                            Delete
                        </button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if($showModal)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
            <h2 class="text-2xl font-bold mb-4 text-blue-600">Add New Staff</h2>

            <!-- Form -->
            <form wire:submit.prevent="save">
                <div>
                    <label class="block font-semibold">Name:</label>
                    <input type="text" wire:model="name" class="w-full border p-2 rounded">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-2">
                    <label class="block font-semibold">Email:</label>
                    <input type="email" wire:model="email" class="w-full border p-2 rounded">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-2">
                    <label class="block font-semibold">Role:</label>
                    <select wire:model="role" class="w-full border p-2 rounded">
                        <option value="">Select Role</option>
                        <option value="doctor">Doctor</option>
                        <option value="midwife">Midwife</option>
                    </select>
                    @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mt-2">
                    <label class="block font-semibold">Password:</label>
                    <input type="password" wire:model="password" class="w-full border p-2 rounded">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Buttons -->
                <div class="mt-4 flex gap-2">
                    <button type="button" wire:click="closeModal" class="bg-gray-400 text-white px-4 py-2 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
