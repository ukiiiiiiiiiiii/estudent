<table class="table" id="table_data_filter">
    <thead class="thead-blue">
    <tr>
        <th class="col-md-3 border-top-0 pt-0 skip-filter" style="color: #285586"></th>
        <th class="col-md-3 border-top-0 pt-0" style="color: #285586">Сви предмети</th>
        <th class="col-md-2 text-center border-top-0 pt-0 skip-filter" style="color: #285586"></th>
        <th class="col-md-2 text-center border-top-0 pt-0 skip-filter" style="color: #285586"></th>
        <th class="col-md-2 text-center border-top-0 pt-0 skip-filter" style="color: #285586"></th>
    </tr>
    </thead>
    <tbody>
    @forelse($results as $result)
        <tr>
            <td>
                {{$result->user->name}}
            </td>
            <td>
                {{$result->subject->name}}
            </td>
            <td class="text-center">
                {{ date('d.m.Y.', strtotime($result->exam->date)) }}
            </td>
            <td class="text-center">
                {{$result->exam->time}}
            </td>
            <td class="text-center">

                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#mark{{$result->id}}">
                    Унеси оцену
                </button>

                <div class="modal fade" id="mark{{$result->id}}" tabindex="-1" role="dialog" aria-labelledby="mark{{$result->id}}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mark">Унос оцене</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <div class="col-md-5 text-md-right">Студент</div>

                                    <div class="col-md-6 font-weight-bold">
                                        {{$result->user->name}}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-5 text-md-right">Предмет</div>

                                    <div class="col-md-6 font-weight-bold">
                                        {{$result->subject->name}}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-5 text-md-right">Година</div>

                                    <div class="col-md-6 font-weight-bold">
                                        {{$result->subject->grade}}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-5 text-md-right">ЕСПБ</div>

                                    <div class="col-md-6 font-weight-bold">
                                        {{$result->subject->espb}}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-5 text-md-right">Датум полагања</div>

                                    <div class="col-md-6 font-weight-bold">
                                        {{ date('d.m.Y.', strtotime($result->exam->date)) }} године
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-5 text-md-right">Време полагања</div>

                                    <div class="col-md-6 font-weight-bold">
                                        {{ $result->exam->time }} часова
                                    </div>
                                </div>

                                <form action="{{ route('employee.updateResult') }}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-5 col-form-label text-md-right">Оцена</div>

                                        <div class="col-md-1"></div>

                                        <div class="col-md-4 font-weight-bold">
                                            <select class="form-control @error('result') is-invalid @enderror text-center" id="result" name="result" required oninvalid="this.setCustomValidity('Унесите оцену!')" oninput="setCustomValidity('')">
                                                <option value="">Изабери</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>

                                        @error('result')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <input type="text" name="result_id" id="result_id" value="{{ $result->id }}" hidden>
                                    <input type="text" name="program_id" id="program_id" value="{{ $result->subject->program_id }}" hidden>

                                    <div class="modal-footer pb-0">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Одустани</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Потврди</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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

