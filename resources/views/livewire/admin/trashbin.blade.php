<div class="p-4">
    <h2 class="text-lg font-bold mb-4">Trash Bin</h2>

    <table class="w-full border text-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Role</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trashBins as $item)
                <tr>
                    <td class="p-2 border text-center">{{ $item->user?->name ?? 'N/A' }}</td>
                    <td class="p-2 border text-center">{{ $item->user?->email ?? 'N/A' }}</td>
                    <td class="p-2 border text-center">
                        @php
                            $role = $item->user?->is_admin == 2 ? 'Doctor' : 'Midwife';
                        @endphp
                        {{ $item->user ? $role : 'N/A' }}
                    </td>
                    <td class="p-2 border space-x-2 text-center">
                        <button wire:click="retrieve({{ $item->id }})" class="bg-green-500 text-white px-2 py-1 rounded">Retrieve</button>
                        <button wire:click="deletePermanently({{ $item->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center p-4 text-gray-500">No deleted users.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
