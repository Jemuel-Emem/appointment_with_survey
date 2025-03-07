<div>
  <div class="flex justify-end">
      <!-- Button to open modal -->
      <button wire:click="$set('showModal', true)" class="px-4 py-2 bg-blue-500 text-white rounded w-64">
        Add Patient
    </button>
  </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-3/4 max-h-[90vh] overflow-y-auto">
                <h2 class="text-lg font-bold mb-4">Add Patient</h2>

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
                        <div>
                            <label class="block text-sm font-medium">Purok/Zone</label>
                            <input type="text" wire:model="purok_zone" class="w-full border rounded p-2">
                            @error('purok_zone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Years of Residency</label>
                            <input type="number" wire:model="years_of_residency" class="w-full border rounded p-2">
                            @error('years_of_residency') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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

                        <!-- Health Information -->
                        <div class="col-span-3 font-bold text-lg">Health Information</div>
                        <div>
                            <label class="block text-sm font-medium">PhilHealth Member</label>
                            <select wire:model="philhealth_member" class="w-full border rounded p-2">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>

                            @error('philhealth_member') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">PhilHealth Number</label>
                            <input type="text" wire:model="philhealth_number" class="w-full border rounded p-2">
                            @error('philhealth_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Existing Medical Conditions</label>
                            <textarea wire:model="existing_medical_conditions" class="w-full border rounded p-2"></textarea>
                            @error('existing_medical_conditions') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Allergies</label>
                            <textarea wire:model="allergies" class="w-full border rounded p-2"></textarea>
                            @error('allergies') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Current Medications</label>
                            <textarea wire:model="current_medications" class="w-full border rounded p-2"></textarea>
                            @error('current_medications') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Past Surgeries/Hospitalizations</label>
                            <textarea wire:model="past_surgeries" class="w-full border rounded p-2"></textarea>
                            @error('past_surgeries') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Family Medical History</label>
                            <textarea wire:model="family_medical_history" class="w-full border rounded p-2"></textarea>
                            @error('family_medical_histor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">COVID-19 Fully Vaccinated</label>
                            <select wire:model="covid_vaccinated" class="w-full border rounded p-2">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('covid_vaccinated') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Other Vaccinations Received</label>
                            <textarea wire:model="other_vaccinations_received" class="w-full border rounded p-2"></textarea>
                            @error('other_vaccinations_received') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Category -->
                        <div class="col-span-3">
                            <label class="block text-sm font-medium">Category</label>
                            <div class="flex gap-4">
                                <label><input type="checkbox" wire:model="category" value="Pregnant"> Pregnant</label>
                                <label><input type="checkbox" wire:model="category" value="Newborn"> Newborn</label>
                                <label><input type="checkbox" wire:model="category" value="PWD"> PWD</label>
                                <label><input type="checkbox" wire:model="category" value="Senior Citizen"> Senior Citizen</label>
                                <label><input type="checkbox" wire:model="category" value="Others"> Others</label>
                            </div>

                            @error('category') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>


                        <div class="col-span-3">
                            <label class="block text-sm font-medium">Months Pregnant/Newborn (if applicable)</label>
                            <input type="text" wire:model="months_pregnant_newborn" class="w-full border rounded p-2">
                            @error('months_pregnant_newborn') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Under Medical Treatment</label>
                            <select wire:model="under_medical_treatment" class="w-full border rounded p-2">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('under_medical_treatment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium">Treatment Details</label>
                            <textarea wire:model="treatment_details" class="w-full border rounded p-2"></textarea>
                            @error('treatment_details') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="" wire:click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded">Close</button>
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    @endif


    <div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Full Name</th>
                        <th class="px-4 py-2 border">Age</th>
                        <th class="px-4 py-2 border">Gender</th>
                        <th class="px-4 py-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $patient)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $patient->id }}</td>
                            <td class="border px-4 py-2 text-center">{{ $patient->full_name }}</td>
                            <td class="border px-4 py-2 text-center">{{ $patient->age }}</td>
                            <td class="border px-4 py-2 text-center">{{ $patient->gender }}</td>
                            <td class="border px-4 py-2 text-center">
                                <button wire:click="showPatient({{ $patient->id }})" class="px-2 py-1 bg-blue-500 text-white rounded">Show Details</button>
                                <button wire:click="editPatient({{ $patient->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                                <button wire:click="deletePatient({{ $patient->id }})" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($viewAllModal && $selectedPatient)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-3/4 max-h-[90vh] overflow-y-auto">
                <h2 class="text-2xl font-bold mb-4 text-center">Patient Details</h2>

                <div class="grid grid-cols-3 gap-6">
                    <!-- Column 1 -->
                    <div>
                        <h3 class="text-lg font-semibold border-b pb-2">Personal Information</h3>
                        <p><strong>Household ID:</strong> {{ $selectedPatient->household_id }}</p>
                        <p><strong>Full Name:</strong> {{ $selectedPatient->full_name }}</p>
                        <p><strong>Date of Birth:</strong> {{ $selectedPatient->date_of_birth }}</p>
                        <p><strong>Age:</strong> {{ $selectedPatient->age }}</p>
                        <p><strong>Gender:</strong> {{ $selectedPatient->gender }}</p>
                        <p><strong>Civil Status:</strong> {{ $selectedPatient->civil_status }}</p>
                        <p><strong>Contact Number:</strong> {{ $selectedPatient->contact_number }}</p>
                        <p><strong>Email:</strong> {{ $selectedPatient->email }}</p>
                        <p><strong>Home Address:</strong> {{ $selectedPatient->home_address }}</p>
                        <p><strong>Purok/Zone:</strong> {{ $selectedPatient->purok_zone }}</p>
                        <p><strong>Years of Residency:</strong> {{ $selectedPatient->years_of_residency }}</p>
                    </div>

                    <!-- Column 2 -->
                    <div>
                        <h3 class="text-lg font-semibold border-b pb-2">Emergency Contact</h3>
                        <p><strong>Contact Name:</strong> {{ $selectedPatient->emergency_contact_name }}</p>
                        <p><strong>Relationship:</strong> {{ $selectedPatient->emergency_contact_relationship }}</p>
                        <p><strong>Contact Number:</strong> {{ $selectedPatient->emergency_contact_number }}</p>
                        <p><strong>Alternate Contact Number:</strong> {{ $selectedPatient->emergency_alt_contact_number }}</p>

                        <h3 class="text-lg font-semibold border-b pb-2 mt-4">Category</h3>
                        <p><strong>Categories:</strong> {{ implode(', ', json_decode($selectedPatient->category, true) ?? []) }}</p>
                        @if(in_array('Pregnant', json_decode($selectedPatient->category, true) ?? []))
                            <p><strong>Months Pregnant/Newborn:</strong> {{ $selectedPatient->months_pregnant_newborn }}</p>
                        @endif
                    </div>

                    <!-- Column 3 -->
                    <div>
                        <h3 class="text-lg font-semibold border-b pb-2">Health Information</h3>
                        <p><strong>PhilHealth Member:</strong> {{ $selectedPatient->philhealth_member ? 'Yes' : 'No' }}</p>
                        <p><strong>PhilHealth Number:</strong> {{ $selectedPatient->philhealth_number }}</p>
                        <p><strong>Existing Medical Conditions:</strong> {{ $selectedPatient->existing_medical_conditions }}</p>
                        <p><strong>Allergies:</strong> {{ $selectedPatient->allergies }}</p>
                        <p><strong>Current Medications:</strong> {{ $selectedPatient->current_medications }}</p>
                        <p><strong>Past Surgeries:</strong> {{ $selectedPatient->past_surgeries_hospitalizations }}</p>
                        <p><strong>Family Medical History:</strong> {{ $selectedPatient->family_medical_history }}</p>
                        <p><strong>COVID-19 Vaccinated:</strong> {{ $selectedPatient->covid_vaccinated ? 'Yes' : 'No' }}</p>
                        <p><strong>Other Vaccinations:</strong> {{ $selectedPatient->other_vaccinations_received }}</p>

                        <h3 class="text-lg font-semibold border-b pb-2 mt-4">Medical Treatment</h3>
                        <p><strong>Under Medical Treatment:</strong> {{ $selectedPatient->under_medical_treatment ? 'Yes' : 'No' }}</p>
                        <p><strong>Treatment Details:</strong> {{ $selectedPatient->treatment_details }}</p>
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

</div>
