    @forelse($programs as $program)
        <tr>
            <td class="pt-3">{{ $program->name }}</td>
            <td class="text-center">
                <a href="{{ route('employee.createExam', ['id' => $program->id]) }}" class="btn btn-sm btn-info">Прикажи</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="text-center">
                <strong>Креирање распореда испита није могуће! Студијски програми нису креирани.</strong>
            </td>
        </tr>
    @endforelse
    <tr>
        <td colspan="2">{{ $programs->links() }}</td>
    </tr>


