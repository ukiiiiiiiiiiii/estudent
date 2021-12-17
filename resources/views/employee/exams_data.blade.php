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
            Нема резултата претраге
            </td>
        </tr>
    @endforelse
    <tr>
        <td colspan="3">{{ $programs->links() }}</td>
    </tr>


