<div class="p-6">
    <h1 class="text-2xl font-semibold text-gray-700 mb-6">
        School Forms
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- SF1 CARD -->
        <a href="{{ route('students.school-forms.sf1') }}"
           class="group bg-white rounded-xl shadow-md p-6 hover:shadow-xl transition-all duration-300 border border-transparent hover:border-blue-200">

            <div class="flex items-center space-x-4">
                <div class="bg-blue-100 text-blue-600 p-4 rounded-xl text-2xl">
                    <i class="bi bi-file-earmark-text"></i>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">
                        School Form 1 (SF1)
                    </h3>
                    <p class="text-sm text-gray-500">
                        School Register
                    </p>
                </div>
            </div>

            <div class="mt-4 text-sm text-gray-400">
                View enrolled students and generate SF1
            </div>
        </a>

    </div>
</div>
