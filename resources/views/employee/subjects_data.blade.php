<table class="table" id="table_data_filter">
    <thead class="thead-blue">
    <tr>
        <th class="col-md-3 text-center border-top-0 pt-0" style="color: #285586">Сви предмети</th>
        <th class="col-md-4 text-center border-top-0 pt-0" style="color: #285586">Сви студијски програми</th>
        <th class="col-md-2 text-center border-top-0 pt-0" style="color: #285586">Све године</th>
        <th class="col-md-2 text-center border-top-0 pt-0" style="color: #285586">Сви ЕСПБ</th>
        <th class="col-md-1 text-center border-top-0 pt-0"></th>
    </tr>
    </thead>
    <tbody>
@forelse($subjects as $subject)
    <tr>
        <td class="align-middle">{{ $subject->name }}</td>
        <td class="align-middle">{{ $subject->program->name }}</td>
        <td class="align-middle text-center">{{ $subject->grade }}</td>
        <td class="align-middle text-center">{{ $subject->espb }}</td>
        <td class="align-middle text-center">
            <a href="#" class="btn btn-info btn-sm mb-1">Измени</a><br>
            <a href="#" class="btn btn-danger btn-sm">Обриши</a>
        </td>
    </tr>

@empty
    <tr class="text-center">
        <td colspan="5">Нема резултата претраге</td>
    </tr>
@endforelse
</tbody>
</table>
<script src="{{ asset('js/ddtf.js') }}"></script>
<script>
    $('#table_data_filter').ddTableFilter();
</script>
