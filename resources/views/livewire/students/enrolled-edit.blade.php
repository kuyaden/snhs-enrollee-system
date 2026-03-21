<div class="max-w-6xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-xl shadow-lg">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-6 pb-6 border-b border-gray-200 dark:border-zinc-700">
        
        {{-- Title --}}
        <div class="flex-1">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Edit Student Information
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 ml-8">
                Update the student information below. Fields marked with <span class="text-red-500">*</span> are required.
            </p>
        </div>

        {{-- Profile Image --}}
        <div class="flex flex-col items-center gap-3 w-36">
            <div class="relative">
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                @elseif ($student->profile_image)
                    <img src="{{ asset('storage/' . $student->profile_image) }}" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                @else
                    <div class="w-32 h-32 rounded-full bg-gradient-to-br from-gray-200 to-gray-300 dark:from-zinc-700 dark:to-zinc-800 flex items-center justify-center text-gray-500 border-4 border-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                @endif
                
                {{-- Camera Icon Button --}}
                <div class="absolute bottom-0 right-0 transform translate-x-1 -translate-y-1">
                    <label for="photo-upload" class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full shadow-lg cursor-pointer transition-all duration-200 flex items-center justify-center border-2 border-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </label>
                    <input id="photo-upload" type="file" wire:model="photo" accept="image/*" class="hidden" />
                </div>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 text-center mt-2">Click camera icon to upload photo</p>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session()->has('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 dark:bg-green-900/20 dark:border-green-800 flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 dark:text-green-400 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <div>
                <p class="font-medium text-green-800 dark:text-green-300">Success!</p>
                <p class="text-green-700 dark:text-green-400 text-sm mt-1">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-800 flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 dark:text-red-400 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            <div>
                <p class="font-medium text-red-800 dark:text-red-300">Please fix the following errors:</p>
                <ul class="list-disc pl-5 space-y-1 mt-1 text-red-700 dark:text-red-400 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Form --}}
    <form wire:submit.prevent="update" class="space-y-10">
        
        {{-- Personal Information --}}
        <div class="bg-gray-50 dark:bg-zinc-800/50 p-6 rounded-xl border border-gray-200 dark:border-zinc-700">
            <div class="flex items-center gap-2 mb-6">
                <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Personal Information</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <flux:input label="LRN" wire:model.defer="lrn" placeholder="Learner Reference Number"/>
                <flux:input label="First Name" wire:model.defer="first_name"/>
                <flux:input label="Middle Name" wire:model.defer="middle_name" />
                <flux:input label="Last Name" wire:model.defer="last_name"/>
                <flux:input label="Extension Name" wire:model.defer="extension_name" />

                {{-- Sex --}}
                <flux:select label="Sex" wire:model.defer="sex">
                    <option hidden>Select sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </flux:select>

                <flux:input type="number" label="Age" wire:model.defer="age"/>
                <flux:input type="date" label="Birthdate" wire:model.defer="birthdate"/>
                <flux:input label="Birthplace" wire:model.defer="birthplace"/>
                <flux:input label="Mother Tongue" wire:model.defer="mother_tongue" />

                {{-- Religion --}}
                <flux:select label="Religion" wire:model.defer="religion">
                    <option hidden>-- Select Religion --</option>
                    <option value="Roman Catholic">Roman Catholic</option>
                    <option value="Protestant">Protestant</option>
                    <option value="Evangelical">Evangelical</option>
                    <option value="Baptist">Baptist</option>
                    <option value="Methodist">Methodist</option>
                    <option value="Pentecostal">Pentecostal</option>
                    <option value="Seventh-day Adventist">Seventh-day Adventist</option>
                    <option value="Jehovah's Witness">Jehovah's Witness</option>
                    <option value="Iglesia Ni Cristo">Iglesia Ni Cristo</option>
                    <option value="Islam">Islam</option>
                    <option value="Buddhism">Buddhism</option>
                    <option value="Hinduism">Hinduism</option>
                    <option value="Judaism">Judaism</option>
                    <option value="Animism / Indigenous Beliefs">Animism / Indigenous Beliefs</option>
                    <option value="Atheist">Atheist</option>
                    <option value="Agnostic">Agnostic</option>
                    <option value="Mormons">Mormons</option>
                </flux:select>

                <flux:input label="Indigenous Group (IP)" wire:model.defer="ip" />
            </div>
        </div>

        {{-- Address --}}
        <div class="bg-gray-50 dark:bg-zinc-800/50 p-6 rounded-xl border border-gray-200 dark:border-zinc-700">
            <div class="flex items-center gap-2 mb-6">
                <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Address Information</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Barangay --}}
                <flux:select label="Barangay" wire:model.defer="barangay">
                    <option hidden>Select barangay</option>
                    <option value="Balilit">Balilit</option>
                    <option value="Santa Elena">Santa Elena</option>
                    <option value="San Isidro">San Isidro</option>
                    <option value="Tin-Ao">Tin-Ao</option>
                    <option value="Tuya">Tuya</option>
                </flux:select>
                <flux:input label="Street" wire:model.defer="street"/>
                <flux:input label="Municipality" wire:model.defer="municipality"/>
                <flux:input label="Province" wire:model.defer="province"/>
            </div>
        </div>

        {{-- Family Information --}}
        <div class="bg-gray-50 dark:bg-zinc-800/50 p-6 rounded-xl border border-gray-200 dark:border-zinc-700">
            <div class="flex items-center gap-2 mb-6">
                <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Family Information</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <flux:input label="Father's Name" wire:model.defer="father_name" />
                <flux:input label="Mother's Name" wire:model.defer="mother_name" />
                <flux:input label="Guardian's Name" wire:model.defer="guardian_name" />
                <flux:input label="Contact Number" wire:model.defer="contact_number" />
            </div>
        </div>

        {{-- Academic --}}
        <div class="bg-gray-50 dark:bg-zinc-800/50 p-6 rounded-xl border border-gray-200 dark:border-zinc-700">
            <div class="flex items-center gap-2 mb-6">
                <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Academic Information</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Grade Level --}}
                <flux:select label="Grade Level" wire:model.defer="grade_level">
                    <option hidden>Select grade level</option>
                    @for ($i = 7; $i <= 12; $i++)
                        <option value="{{ $i }}">Grade {{ $i }}</option>
                    @endfor
                </flux:select>

                <flux:input label="Section" wire:model.defer="student_section"/>

                <flux:select label="Enrollment Status" wire:model.defer="enrollment_status">
                    <option hidden>-- Select --</option>
                    <option value="Enrolled">Enrolled</option>
                    <option value="Pending">Pending</option>
                    <option value="Dropped">Dropped</option>
                </flux:select>

                <flux:input type="number" label="Enrollment Year" wire:model.defer="enrollment_year"/>

                <flux:select label="4Ps Beneficiary" wire:model.defer="is_4ps">
                    <option value="">-- Select --</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </flux:select>

                {{-- PWD --}}
                <flux:select label="PWD" wire:model.defer="is_pwd">
                    <option value="">-- Select --</option>
                    <option value="None">None</option>
                    <option value="Deaf/Hard of Hearing">Deaf/Hard of Hearing</option>
                    <option value="Intellectual Disability">Intellectual Disability</option>
                    <option value="Learning Disability">Learning Disability</option>
                    <option value="Mental Disability">Mental Disability</option>
                    <option value="Orthopedic/Physical Disability">Orthopedic/Physical Disability</option>
                    <option value="Psychosocial Disability">Psychosocial Disability</option>
                    <option value="Speech and Language Disability">Speech and Language Disability</option>
                    <option value="Visual Disability">Visual Disability</option>
                </flux:select>
            </div>
        </div>

        {{-- Uploads --}}
        <div class="bg-gray-50 dark:bg-zinc-800/50 p-6 rounded-xl border border-gray-200 dark:border-zinc-700">
            <div class="flex items-center gap-2 mb-6">
                <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Document Uploads</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                {{-- Form 137 / Report Card --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Form 137 / Report Card
                    </label>
                    <div class="flex items-center">
                        <label for="form_one_three" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-white dark:bg-zinc-800 border-gray-300 dark:border-zinc-600 hover:border-blue-500 dark:hover:border-blue-400 transition-colors duration-200">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PDF, JPG, PNG (MAX. 5MB)</p>
                            </div>
                            <input id="form_one_three" type="file" wire:model="form_one_three" accept=".pdf,.jpg,.jpeg,.png" class="hidden" />
                        </label>
                    </div>
                </div>

                {{-- Live Birth Certificate --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Live Birth Certificate
                    </label>
                    <div class="flex items-center">
                        <label for="live_birth" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-white dark:bg-zinc-800 border-gray-300 dark:border-zinc-600 hover:border-blue-500 dark:hover:border-blue-400 transition-colors duration-200">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span></p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PDF, JPG, PNG (MAX. 5MB)</p>
                            </div>
                            <input id="live_birth" type="file" wire:model="live_birth" accept=".pdf,.jpg,.jpeg,.png" class="hidden" />
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-zinc-700">
            <flux:button type="button" variant="outline" color="gray" class="px-6" onclick="window.location.href='{{ route('students.enrolled-list') }}'">
                Cancel
            </flux:button>
            <flux:button type="submit" variant="primary" color="blue" class="px-6">
                Update Student
            </flux:button>
        </div>
    </form>
</div>