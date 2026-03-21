<div class="max-w-7xl mx-auto p-6 bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
    {{-- Header --}}
    <div class="text-center mb-8 pb-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-center gap-3 mb-4">
            <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Student Enrollment Form</h1>
        </div>
        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
            Complete the student's information below to enroll them in our system
        </p>
    </div>

    {{-- Success Message --}}
    @if (session()->has('success'))
        <div class="mb-8 p-4 rounded-xl bg-green-50 border border-green-200 dark:bg-green-900/20 dark:border-green-800 flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 dark:text-green-400 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <div>
                <p class="font-medium text-green-800 dark:text-green-300">Success!</p>
                <p class="text-green-700 dark:text-green-400 text-sm mt-1">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- FORM --}}
    <form wire:submit.prevent="save" enctype="multipart/form-data" id="student-form" class="space-y-8">

        {{-- Enrollment Information Card --}}
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/10 dark:to-indigo-900/10 p-6 rounded-2xl border border-blue-100 dark:border-blue-800">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-blue-500 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Enrollment Information</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <flux:label for="enrollment_year" class="font-medium">Enrollment Year</flux:label>
                    <flux:input type="number" id="enrollment_year" wire:model.defer="enrollment_year" min="2000" max="{{ now()->year + 1 }}" placeholder="e.g. 2025" />
                    @error('enrollment_year') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <flux:label for="enrollment_status" class="font-medium">Enrollment Status</flux:label>
                    <flux:select id="enrollment_status" wire:model.defer="enrollment_status">
                        <option hidden>Select status</option>
                        <option value="New">New</option>
                        <option value="Returning">Returning</option>
                        <option value="Transferred">Transferred</option>
                        <option value="Continuing">Continuing</option>
                    </flux:select>
                    @error('enrollment_status') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <flux:label for="lrn" class="font-medium">Learner Reference Number (LRN)</flux:label>
                    <flux:input id="lrn"
                        wire:model.defer="lrn"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                        maxlength="12"
                        placeholder="Enter 12-digit LRN"
                        class="{{ $errors->has('lrn') ? 'border-red-500' : '' }}" />
                    @error('lrn') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        {{-- Student Information Card --}}
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/10 dark:to-emerald-900/10 p-6 rounded-2xl border border-green-100 dark:border-green-800">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-green-500 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Student Information</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Name Fields --}}
                <div class="md:col-span-2 lg:col-span-1">
                    <flux:label for="last_name" class="font-medium">Last Name</flux:label>
                    <flux:input id="last_name"
                        wire:model.defer="last_name"
                        placeholder="Enter last name"
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())"
                        class="{{ $errors->has('last_name') ? 'border-red-500' : '' }}" />
                    @error('last_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2 lg:col-span-1">
                    <flux:label for="first_name" class="font-medium">First Name</flux:label>
                    <flux:input id="first_name"
                        wire:model.defer="first_name"
                        placeholder="Enter first name"
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())"
                        class="{{ $errors->has('first_name') ? 'border-red-500' : '' }}" />
                    @error('first_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2 lg:col-span-1">
                    <flux:label for="middle_name" class="font-medium">Middle Name</flux:label>
                    <flux:input id="middle_name"
                        wire:model.defer="middle_name"
                        placeholder="Enter middle name"
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())"
                        class="{{ $errors->has('middle_name') ? 'border-red-500' : '' }}" />
                    @error('middle_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2 lg:col-span-1">
                    <flux:label for="extension_name" class="font-medium">Extension Name</flux:label>
                    <flux:input id="extension_name"
                        wire:model.defer="extension_name"
                        placeholder="Jr., III, etc"
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())"
                        class="{{ $errors->has('extension_name') ? 'border-red-500' : '' }}" />
                    @error('extension_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Personal Details --}}
                <div>
                    <flux:label for="age" class="font-medium">Age</flux:label>
                    <flux:input id="age"
                        wire:model.defer="age"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
                        maxlength="2"
                        placeholder="Enter age"
                        class="{{ $errors->has('age') ? 'border-red-500' : '' }}" />
                    @error('age') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <flux:label for="sex" class="font-medium">Sex</flux:label>
                    <flux:select id="sex" wire:model.defer="sex">
                        <option hidden>Select sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </flux:select>
                    @error('sex') <span class="text-red-500 text-sm mt-1 block">Please select Male or Female.</span> @enderror
                </div>

                <div>
                    <flux:label for="birthdate" class="font-medium">Birthdate</flux:label>
                    <flux:input type="date" id="birthdate" wire:model.defer="birthdate" />
                    @error('birthdate') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <flux:label for="birthplace" class="font-medium">Birthplace</flux:label>
                    <flux:input id="birthplace"
                        wire:model.defer="birthplace"
                        placeholder="Enter birthplace"
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())"
                        class="{{ $errors->has('birthplace') ? 'border-red-500' : '' }}" />
                    @error('birthplace') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Academic & Background --}}
                <div>
                    <flux:label for="grade_level" class="font-medium">Grade Level</flux:label>
                    <flux:select id="grade_level" wire:model="grade_level">
                        <option value="">Select grade</option>
                        @for ($i = 7; $i <= 12; $i++)
                            <option value="{{ $i }}">Grade {{ $i }}</option>
                        @endfor
                    </flux:select>
                    @error('grade_level') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <flux:label for="mother_tongue" class="font-medium">Mother Tongue</flux:label>
                    <flux:input id="mother_tongue"
                        wire:model.defer="mother_tongue"
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                        placeholder="Enter mother tongue"
                        class="{{ $errors->has('mother_tongue') ? 'border-red-500' : '' }}" />
                    @error('mother_tongue') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <flux:label for="ip" class="font-medium">Indigenous People (IP)</flux:label>
                    <flux:select id="ip" wire:model.defer="ip">
                        <option hidden>Select option</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </flux:select>
                </div>

                <div>
                    <flux:label for="is_4ps" class="font-medium">4Ps Beneficiary</flux:label>
                    <flux:select id="is_4ps" wire:model.defer="is_4ps">
                        <option hidden>Select option</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </flux:select>
                </div>

                {{-- Religion --}}
                <div class="md:col-span-2">
                    <flux:label for="religion" class="font-medium">Religion</flux:label>
                    <flux:select id="religion" wire:model.live="religion" 
                        placeholder="-- Select Religion --"
                        class="{{ $errors->has('religion') ? 'border-red-500' : '' }}">
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
                        <option value="Others">Others (please specify)</option>
                    </flux:select>
                    @error('religion') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror

                    @if($religion === 'Others')
                        <div class="mt-3">
                            <flux:label for="other_religion" class="font-medium">Please specify religion:</flux:label>
                            <flux:textarea id="other_religion" wire:model="other_religion"
                                placeholder="Enter your religion"
                                rows="2"
                                class="{{ $errors->has('other_religion') ? 'border-red-500' : '' }}" />
                            @error('other_religion') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>

                {{-- Disability --}}
                <div class="md:col-span-2">
                    <flux:label for="is_pwd" class="font-medium">Type of Disability</flux:label>
                    <flux:select id="is_pwd" wire:model.live="is_pwd" 
                        placeholder="Select option"
                        class="{{ $errors->has('is_pwd') ? 'border-red-500' : '' }}">
                        <option value="None">None</option>
                        <option value="Deaf/Hard of Hearing">Deaf/Hard of Hearing</option>
                        <option value="Intellectual Disability">Intellectual Disability</option>
                        <option value="Learning Disability">Learning Disability</option>
                        <option value="Mental Disability">Mental Disability</option>
                        <option value="Orthopedic/Physical Disability">Orthopedic/Physical Disability</option>
                        <option value="Psychosocial Disability">Psychosocial Disability</option>
                        <option value="Speech and Language Disability">Speech and Language Disability</option>
                        <option value="Visual Disability">Visual Disability</option>
                        <option value="Others">Others (please specify)</option>
                    </flux:select>
                    @error('is_pwd') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror

                    @if($is_pwd === 'Others')
                        <div class="mt-3">
                            <flux:label for="other_disability" class="font-medium">Please specify disability:</flux:label>
                            <flux:textarea id="other_disability" wire:model="other_disability"
                                placeholder="Enter disability type"
                                rows="2"
                                class="{{ $errors->has('other_disability') ? 'border-red-500' : '' }}" />
                            @error('other_disability') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Address Information Card --}}
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/10 dark:to-pink-900/10 p-6 rounded-2xl border border-purple-100 dark:border-purple-800">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-purple-500 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Address Information</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <flux:label for="street" class="font-medium">House No. / Street / Purok</flux:label>
                    <flux:input id="street" wire:model.defer="street" placeholder="Enter complete street address" />
                </div>

                <div>
                    <flux:label for="barangay" class="font-medium">Barangay</flux:label>
                    <flux:select id="barangay" wire:model.defer="barangay">
                        <option hidden>Select barangay</option>
                        <option value="Balilit">Balilit</option>
                        <option value="Santa Elena">Santa Elena</option>
                        <option value="San Isidro">San Isidro</option>
                        <option value="Tin-Ao">Tin-Ao</option>
                        <option value="Tuya">Tuya</option>
                    </flux:select>
                    @error('barangay') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <flux:label for="municipality" class="font-medium">Municipality</flux:label>
                    <flux:select id="municipality" wire:model.defer="municipality">
                        <option value="Tanauan">Tanauan</option>
                        <option value="Dagami">Dagami</option>
                    </flux:select>
                    @error('municipality') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <flux:label for="province" class="font-medium">Province</flux:label>
                    <flux:select id="province" wire:model.defer="province">
                        <option hidden>Select option</option>
                        <option value="Leyte">Leyte</option>
                    </flux:select>
                    @error('province') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        {{-- Parent/Guardian Information Card --}}
        <div class="bg-gradient-to-r from-orange-50 to-amber-50 dark:from-orange-900/10 dark:to-amber-900/10 p-6 rounded-2xl border border-orange-100 dark:border-orange-800">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-orange-500 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Parent / Guardian Information</h2>
            </div>

            {{-- Father's Information --}}
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Father's Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div class="md:col-span-2 lg:col-span-3">
                        <flux:label for="father_name" class="font-medium">Father's Name</flux:label>
                        <flux:input id="father_name"
                            wire:model.defer="father_name"
                            placeholder="Enter father's name"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())"
                            class="{{ $errors->has('father_name') ? 'border-red-500' : '' }}" />
                        @error('father_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <flux:label for="father_occupation" class="font-medium">Occupation</flux:label>
                        <flux:input id="father_occupation"
                            wire:model.defer="father_occupation"
                            placeholder="Occupation"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())"
                            class="{{ $errors->has('father_occupation') ? 'border-red-500' : '' }}" />
                        @error('father_occupation') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <flux:label for="father_education" class="font-medium">Education</flux:label>
                        <flux:select id="father_education" wire:model.defer="father_education">
                            <option hidden>Education</option>
                            <option value="None">None</option>
                            <option value="Elementary">Elementary</option>
                            <option value="High School">High School</option>
                            <option value="College">College</option>
                            <option value="Graduate">Graduate</option>
                        </flux:select>
                        @error('father_education') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <flux:label for="father_income" class="font-medium">Monthly Income</flux:label>
                        <flux:input type="number" id="father_income"
                            wire:model.defer="father_income"
                            placeholder="Income"
                            class="{{ $errors->has('father_income') ? 'border-red-500' : '' }}" />
                        @error('father_income') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <flux:label for="father_disability" class="font-medium">Has Disability?</flux:label>
                        <flux:select id="father_disability" wire:model.defer="father_disability">
                            <option hidden>Select</option>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </flux:select>
                        @error('father_disability') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- Mother's Information --}}
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Mother's Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div class="md:col-span-2 lg:col-span-3">
                        <flux:label for="mother_name" class="font-medium">Mother's Name</flux:label>
                        <flux:input id="mother_name"
                            wire:model.defer="mother_name"
                            placeholder="Enter mother's name"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())"
                            class="{{ $errors->has('mother_name') ? 'border-red-500' : '' }}" />
                        @error('mother_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <flux:label for="mother_occupation" class="font-medium">Occupation</flux:label>
                        <flux:input id="mother_occupation"
                            wire:model.defer="mother_occupation"
                            placeholder="Occupation"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())"
                            class="{{ $errors->has('mother_occupation') ? 'border-red-500' : '' }}" />
                        @error('mother_occupation') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <flux:label for="mother_education" class="font-medium">Education</flux:label>
                        <flux:select id="mother_education" wire:model.defer="mother_education">
                            <option hidden>Education</option>
                            <option value="None">None</option>
                            <option value="Elementary">Elementary</option>
                            <option value="High School">High School</option>
                            <option value="College">College</option>
                            <option value="Graduate">Graduate</option>
                        </flux:select>
                        @error('mother_education') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <flux:label for="mother_income" class="font-medium">Monthly Income</flux:label>
                        <flux:input type="number" id="mother_income"
                            wire:model.defer="mother_income"
                            placeholder="Income"
                            class="{{ $errors->has('mother_income') ? 'border-red-500' : '' }}" />
                        @error('mother_income') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <flux:label for="mother_disability" class="font-medium">Has Disability?</flux:label>
                        <flux:select id="mother_disability" wire:model.defer="mother_disability">
                            <option hidden>Select</option>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </flux:select>
                        @error('mother_disability') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- Guardian's Information --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Guardian's Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <flux:label for="guardian_name" class="font-medium">Guardian's Name</flux:label>
                        <flux:input id="guardian_name"
                            wire:model.defer="guardian_name"
                            placeholder="Enter guardian's name"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())"
                            class="{{ $errors->has('guardian_name') ? 'border-red-500' : '' }}" />
                        @error('guardian_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <flux:label for="guardian_income" class="font-medium">Monthly Income</flux:label>
                        <flux:input type="number" id="guardian_income"
                            wire:model.defer="guardian_income"
                            placeholder="Income"
                            class="{{ $errors->has('guardian_income') ? 'border-red-500' : '' }}" />
                        @error('guardian_income') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <flux:label for="guardian_disability" class="font-medium">Has Disability?</flux:label>
                        <flux:select id="guardian_disability" wire:model.defer="guardian_disability">
                            <option hidden>Select</option>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </flux:select>
                        @error('guardian_disability') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2 lg:col-span-2">
                        <flux:label for="contact_number" class="font-medium">Emergency Contact Number</flux:label>
                        <flux:input id="contact_number"
                            wire:model.defer="contact_number"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            maxlength="11"
                            pattern="09[0-9]{9}"
                            placeholder="09XXXXXXXXX"
                            class="{{ $errors->has('contact_number') ? 'border-red-500' : '' }}" />
                        @error('contact_number') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Document Uploads Card --}}
        <div class="bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/10 dark:to-rose-900/10 p-6 rounded-2xl border border-red-100 dark:border-red-800">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-red-500 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Document Uploads</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Live Birth Certificate --}}
                <div class="space-y-4">
                    <div class="text-center">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-2xl inline-flex mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <flux:label class="font-medium block">Live Birth Certificate</flux:label>
                    </div>
                    
                    <div class="space-y-3">
                        <div>
                            <flux:label for="live_birth" class="text-sm">Page 1</flux:label>
                            <input type="file" wire:model="live_birth" accept=".pdf,image/*"
                                class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/30 dark:file:text-blue-300" />
                            @error('live_birth') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <flux:label for="live_birth_one" class="text-sm">Page 2</flux:label>
                            <input type="file" wire:model="live_birth_one" accept=".pdf,image/*"
                                class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/30 dark:file:text-blue-300" />
                            @error('live_birth_one') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <flux:label for="live_birth_two" class="text-sm">Page 3</flux:label>
                            <input type="file" wire:model="live_birth_two" accept=".pdf,image/*"
                                class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/30 dark:file:text-blue-300" />
                            @error('live_birth_two') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- Form 137 --}}
                <div class="space-y-4">
                    <div class="text-center">
                        <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-2xl inline-flex mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <flux:label class="font-medium block">Form 137</flux:label>
                    </div>
                    
                    <div>
                        <input type="file" wire:model="form_one_three" accept=".pdf,image/*"
                            class="mt-6 block w-full text-sm text-gray-700 dark:text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 dark:file:bg-red-900/30 dark:file:text-red-300" />
                        @error('form_one_three') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Student Photo --}}
                <div class="space-y-4">
                    <div class="text-center">
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-2xl inline-flex mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <flux:label class="font-medium block">Student Photo</flux:label>
                    </div>
                    
                    <div>
                        <input type="file" wire:model="profile_image" accept="image/*"
                            class="mt-6 block w-full text-sm text-gray-700 dark:text-gray-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 dark:file:bg-green-900/30 dark:file:text-green-300" />
                        @error('profile_image') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-center mt-8">
            <flux:button variant="primary" color="zinc" class="!px-8 !py-3 text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 mr-4" href="{{ route('students.enrolled-list') }}">
                    Cancel
                </flux:button>
            <flux:modal.trigger name="confirm-submit">
                <flux:button variant="primary" class="!px-8 !py-3 text-lg font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                    Submit Enrollment
                </flux:button>
            </flux:modal.trigger>
        </div>
        
    </form>

    {{-- Confirmation Modal --}}
    <flux:modal name="confirm-submit" class="min-w-[28rem] rounded-2xl">
        <div class="space-y-6 p-6">
            <div class="text-center">
                <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-2xl inline-flex mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <flux:heading size="lg" class="mb-2">Confirm Submission</flux:heading>
                <flux:text class="text-gray-600 dark:text-gray-400">
                    <p>You are about to submit this student's enrollment form.</p>
                    <p class="mt-1">Please ensure all details are correct before continuing.</p>
                </flux:text>
            </div>

            <div class="flex gap-3 justify-center">
                <flux:modal.close>
                    <flux:button variant="ghost" class="!px-6">Cancel</flux:button>
                </flux:modal.close>
                <flux:button wire:click="save" variant="primary" class="!px-6">
                    Confirm & Submit
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>