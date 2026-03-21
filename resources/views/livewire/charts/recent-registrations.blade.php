<div class="w-full bg-white dark:bg-neutral-900 rounded-xl shadow-lg p-6 transition-all duration-300 hover:shadow-xl hover:border hover:border-blue-200">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200 flex items-center gap-2">
            <i class="bi bi-person-lines-fill text-blue-500"></i>
            Recent Registrations
        </h2>
        <a href="{{ route('students.enrolled-list') }}" 
           class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
           View All →
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-neutral-700">
        <table class="w-full text-sm text-left">
            <thead class="text-xs uppercase bg-gradient-to-r from-blue-50 to-blue-100 dark:from-neutral-800 dark:to-neutral-700 text-gray-700 dark:text-gray-200">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Grade</th>
                    <th class="px-4 py-3">Gender</th>
                    <th class="px-4 py-3">Date Registered</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @forelse($recentStudents as $student)
                    <tr class="hover:bg-blue-50 dark:hover:bg-neutral-800 transition-colors">
                        <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-100">
                            {{ $student->first_name }} {{ $student->last_name }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300">
                                {{ $student->grade_level }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ strtolower($student->sex) === 'male' 
                                    ? 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300' 
                                    : 'bg-pink-100 text-pink-700 dark:bg-pink-900 dark:text-pink-300' }}">
                                {{ ucfirst($student->sex) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                            {{ $student->created_at->format('M d, Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                            No recent registrations
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
