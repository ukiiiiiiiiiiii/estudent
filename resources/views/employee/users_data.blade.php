<table class="table" id="table_data_filter">
    <thead class="thead-blue">
    <tr>
        <th class="col-md-2 text-center border-top-0 pt-0 skip-filter" style="color: #285586"></th>
        <th class="col-md-2 text-center border-top-0 pt-0 skip-filter" style="color: #285586"></th>
        <th class="col-md-4 text-center border-top-0 pt-0" style="color: #285586">Сви студијски програми</th>
        <th class="col-md-2 text-center border-top-0 pt-0" style="color: #285586">Све године</th>
        <th class="col-md-1 text-center border-top-0 pt-0 skip-filter" style="color: #285586"></th>
        <th class="col-md-1 text-center border-top-0 pt-0 skip-filter"></th>
    </tr>
    </thead>
    <tbody>
@forelse($users as $user)
    <tr>
        <td class="align-middle">{{ $user->name }}</td>
        <td class="align-middle text-center">{{ $user->username }}</td>
        <td class="align-middle">{{ $user->program->name }}</td>
        <td class="align-middle text-center">
            @if($user->grade == "1")
                I
            @elseif($user->grade == "2")
                II
            @elseif($user->grade == "3")
                III
            @elseif($user->grade == "4")
                IV
            @endif
            година
        </td>
        <td class="align-middle text-center">{{ $user->espb }}</td>
        <td class="align-middle text-center">
            <a href="{{ route('employee.editUser', ['id' => $user->id]) }}" class="btn btn-sm btn-info mb-1">Измени</a><br>
            <button class="btn btn-danger btn-sm" onclick="store('{{ $user->name }}', {{ $user->id }})">Обриши</button>
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
                Да ли сте сигурни да желите да обришете податке о студенту <br>
                <div class="font-weight-bold" id="userName"></div>
            </div>
            <div class="modal-footer" style="padding-top: 0.40rem">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                <div id="userID"></div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/ddtf.js') }}"></script>

<script>
    $('#table_data_filter').ddTableFilter();
</script>

<script>
    function store(userName, userID) {
        $('#userName').html(userName+"?");

        var id = userID;
        var url = '{{ route("employee.destroyUser", ":id") }}';
        url = url.replace(':id', id);

        $('#userID').html(
            "<a href="+url+" class='btn btn-sm btn-danger'>Обриши</a>"
        );

        $('#ModalDelete').modal('show');
    }
</script>

