    @foreach($programs as $program)
        <tr>
            <td class="pt-3">{{ $program->name }}</td>
            <td class="pt-3 text-center">{{ $program->code }}</td>
            <td class="text-center">
                <a href="{{ route('employee.editProgram', ['id' => $program->id]) }}" class="btn btn-sm btn-info">Измени</a>

                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDelete{{$program->id}}">Обриши</button>

                <div class="modal fade" id="ModalDelete{{$program->id}}" tabindex="-1" aria-labelledby="ModalDelete{{$program->id}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-left" style="padding-bottom: 0.35rem">
                                Да ли сте сигурни да желите да обришете студијски програм <br><b>{{$program->name}}</b>?
                            </div>
                            <div class="modal-footer" style="padding-top: 0.40rem">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                                <a href="{{ route('employee.destroyProgram', ['id' => $program->id]) }}" class="btn btn-sm btn-danger">Обриши</a>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3">{{ $programs->links() }}</td>
    </tr>


