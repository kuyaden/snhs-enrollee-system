<div class="space-y-6">

    {{-- Grade Level Filter + Generate Button --}}
    <div class="flex items-end gap-4 mb-4">
        <div>
            <label class="block mb-2 font-medium">Grade Level</label>
            <select wire:model.live="filterGrade"
                    class="border rounded px-3 py-2">
                <option value="">Select Grade</option>
                @foreach($availableGrades as $grade)
                    <option value="{{ $grade }}">Grade {{ $grade }}</option>
                @endforeach
            </select>
        </div>

        {{-- Generate SF1 Button --}}
        <a href="{{ $filterGrade ? route('sf1.export', $filterGrade) : '#' }}"
           class="px-4 py-2 rounded text-white transition
                  {{ $filterGrade ? 'bg-green-600 hover:bg-green-700' : 'bg-gray-400 cursor-not-allowed' }}"
           @if(!$filterGrade) onclick="return false;" @endif>
            Generate SF1 (Excel)
        </a>
    </div>

    {{-- Students Table --}}
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-3 py-2">Name</th>
                <th class="border px-3 py-2">Gender</th>
                <th class="border px-3 py-2">Grade</th>
                <th class="border px-3 py-2">Barangay</th>
                <th class="border px-3 py-2">LRN</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td class="border px-3 py-2">
                        {{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}
                    </td>
                    <td class="border px-3 py-2">{{ $student->sex }}</td>
                    <td class="border px-3 py-2">{{ $student->grade_level }}</td>
                    <td class="border px-3 py-2">{{ $student->barangay }}</td>
                    <td class="border px-3 py-2">{{ $student->lrn }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border px-3 py-4 text-center">
                        No students found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $students->links() }}
    </div>

</div>
