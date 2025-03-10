<div>
  <div class="flex justify-end">
      <!-- Add Pregnant Button -->
      <button wire:click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded w-64">
        Add Pregnant
    </button>
  </div>

    <!-- Modal -->
    @if($showModal)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl max-h-[90vh] overflow-y-auto">
            <h2 class="text-2xl font-bold mb-4 text-blue-600">Add Pregnant Record</h2>

            <!-- Form -->
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
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
                        <label class="block font-semibold">Remarks:</label>
                        <input type="text" wire:model="remarks" class="w-full border p-2 rounded">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-4 flex gap-2 flex justify-end">
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
