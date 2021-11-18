<table class="table table-bordered">
    <thead class="thead-blue">
    <tr>
        <th class="col-md-5" data-sorting_type="asc" data-column_name="name" style="cursor: pointer">Име и презиме</th>
        <th class="col-md-5" data-sorting_type="asc" data-column_name="username" style="cursor: pointer">Корисничко име</th>
        <th class="col-md-2 text-center">Акција</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->username }}</td>
            <td class="text-center">
                <a href="#" class="btn btn-sm btn-info">Измени</a>
                <a href="#" class="btn btn-sm btn-danger">Обриши</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $employees->links() }}
