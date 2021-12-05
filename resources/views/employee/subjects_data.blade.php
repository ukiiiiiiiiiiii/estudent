<table class="table" id="table_data_filter">
    <thead class="thead-blue">
    <tr>
        <th class="col-md-3 text-center border-top-0 pt-0" style="color: #285586">Сви предмети</th>
        <th class="col-md-4 text-center border-top-0 pt-0" style="color: #285586">Сви студијски програми</th>
        <th class="col-md-2 text-center border-top-0 pt-0" style="color: #285586">Све године</th>
        <th class="col-md-2 text-center border-top-0 pt-0" style="color: #285586">Сви ЕСПБ</th>
        <th class="col-md-1 text-center border-top-0 pt-0">Акција</th>
    </tr>
    </thead>
    <tbody>
@forelse($subjects as $subject)
    <tr>
        <td class="align-middle">{{ $subject->name }}</td>
        <td class="align-middle">{{ $subject->program->name }}</td>
        <td class="align-middle text-center">
            @if($subject->grade == "1")
                I
            @elseif($subject->grade == "2")
                II
            @elseif($subject->grade == "3")
                III
            @elseif($subject->grade == "4")
                IV
            @endif
            година
        </td>
        <td class="align-middle text-center">{{ $subject->espb }}</td>
        <td class="align-middle text-center">
            <a href="{{ route('employee.editSubject', ['id' => $subject->id]) }}" class="btn btn-sm btn-info mb-1">Измени</a><br>
            <button class="btn btn-danger btn-sm" onclick="store('{{ $subject->name }}', {{ $subject->id }})">Обриши</button>
            {{--
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDelete{{$subject->id}}">Обриши</button>

            <div class="modal fade" id="ModalDelete{{$subject->id}}" tabindex="-1" aria-labelledby="ModalDelete{{$subject->id}}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-left" style="padding-bottom: 0.35rem">
                            Да ли сте сигурни да желите да обришете предмет <br><b>{{$subject->name}}</b>?
                        </div>
                        <div class="modal-footer" style="padding-top: 0.40rem">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                            <a href="{{ route('employee.destroySubject', ['id' => $subject->id]) }}" class="btn btn-sm btn-danger">Обриши</a>
                        </div>
                    </div>
                </div>
            </div>
            --}}
        </td>
    </tr>
@empty
    <tr class="text-center">
        <td colspan="5">Нема резултата претраге</td>
    </tr>
@endforelse
</tbody>
</table>

<div class="modal fade" id="ModalDelete" tabindex="-1" aria-labelledby="ModalDelete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-left" style="padding-bottom: 0.35rem">
                Да ли сте сигурни да желите да обришете предмет <br>
                <div class="font-weight-bold" id="subjectName"></div>
            </div>
            <div class="modal-footer" style="padding-top: 0.40rem">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                <div id="subjectID"></div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/ddtf.js') }}"></script>

<script>
    $('#table_data_filter').ddTableFilter();
</script>

<script>
    function store(subjectName, subjectID) {
        $('#subjectName').html(subjectName+"?");

        var id = subjectID;
        var url = '{{ route("employee.destroySubject", ":id") }}';
        url = url.replace(':id', id);

        $('#subjectID').html(
            "<a href="+url+" class='btn btn-sm btn-danger'>Обриши</a>"
        );

        $('#ModalDelete').modal('show');
    }
</script>

