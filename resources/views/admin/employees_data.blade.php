    @foreach($employees as $employee)
        <tr>
            <td class="pt-3">{{ $employee->name }}</td>
            <td class="pt-3">{{ $employee->username }}</td>
            <td class="text-center">
                <a href="{{ route('admin.editEmployee', ['id' => $employee->id]) }}" class="btn btn-sm btn-info">Измени</a>
                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDelete{{$employee->id}}">Обриши</button>

                <div class="modal fade" id="ModalDelete{{$employee->id}}" tabindex="-1" aria-labelledby="ModalDelete{{$employee->id}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-left" style="padding-bottom: 0.35rem">
                                Да ли сте сигурни да желите да обришете корисника <b>{{$employee->name}}</b>?
                            </div>
                            <div class="modal-footer" style="padding-top: 0.40rem">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                                <a href="{{ route('admin.destroyEmployee', ['id' => $employee->id]) }}" class="btn btn-sm btn-danger">Обриши</a>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3">{{ $employees->links() }}</td>
    </tr>
