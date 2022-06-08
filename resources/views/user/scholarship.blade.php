@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs justify-content-center">
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="{{ route('home') }}">Огласна табла</a>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="{{ route('showSubjects') }}">Моји предмети</a>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="{{ route('showSchedule') }}">Распоред наставе</a>
        </li>
        <li id="dropdown-tab" class="nav-item dropdown mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Испити</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('showExams') }}">Распоред и пријава испита</a>
                <a class="dropdown-item" href="{{ route('showRegisteredExam') }}">Пријављени испити</a>
                <a class="dropdown-item" href="{{ route('showSuccessfullyExam') }}">Положени испити</a>
                <a class="dropdown-item" href="{{ route('showUnsuccessfullyExam') }}">Неуспешна полагања</a>
            </div>
        </li>
        @if(Auth::user()->budget == "С")
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link active" href="{{ route('showScholarship') }}">Школарина</a>
        </li>
        @endif
    </ul>

    <div class="container pt-3">
        @if(Auth::user()->budget == "С")
            <div class="nav justify-content-end">
                <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#payment">Налог за уплату</button>
            </div>

            <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="paymentLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 660px">
                    <div class="modal-content">
                        <form action="{{ route('payment') }}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentLabel">Налог за уплату</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>уплатилац</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <textarea rows="3" cols="36" wrap="hard" maxlength="110" readonly>{{Auth::user()->name}}</textarea>
                                        </td>
                                        <td style="padding-left: 40px" class="align-top">
                                            шифра<br>
                                            <input type="text" value="253" style="width: 50px" readonly>
                                        </td>
                                        <td style="padding-left: 5px" class="align-top">
                                            валута<br>
                                            <input type="text" maxlength="3" value="РСД" style="width: 50px" readonly>
                                        </td>
                                        <td style="padding-left: 5px" class="align-top">
                                            износ<br>
                                            <input type="number" style="width: 190px; max-height: 29px" name="money" id="money" class="form-control @error('money') is-invalid @enderror" required oninvalid="this.setCustomValidity('Унесите нумеричку вредност!')"  oninput="setCustomValidity('')">
                                            @error('money')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 5px">сврха уплате</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <textarea rows="3" cols="36" wrap="hard" maxlength="110" readonly>Студентски веб сервис</textarea>
                                        </td>
                                        <td style="padding-left: 40px" colspan="3" class="align-top">
                                            рачун примаоца<br>
                                            <input type="text" style="width: 305px" value="840-0000031304845-23" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 10px">прималац</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <textarea rows="3" cols="36" wrap="hard" maxlength="110" readonly>КРИМИНАЛИСТИЧКО-ПОЛИЦИЈСКИ УНИВЕРЗИТЕТ</textarea>
                                        </td>
                                        <td style="padding-left: 40px" colspan="3" class="align-top">
                                            модел и позив на број (одобрење)<br>
                                            <input type="text" style="width: 40px" value="97" readonly>
                                            <input type="text" style="width: 260px" value="{{ Auth::user()->username }}" readonly>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Уплати</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6 text-md-right">Новчана средства</div>

                        <div class="col-md-6 font-weight-bold">
                            {{ Auth::user()->money }} динара
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 text-md-right">Уплаћена школарина</div>

                        <div class="col-md-6 font-weight-bold">
                            {{ Auth::user()->paid }} динара
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 text-md-right">Дуг</div>

                        <div class="col-md-6 font-weight-bold">
                            {{ 81000 - Auth::user()->paid }} динара
                        </div>
                    </div>

                    <form action="{{ route('updateScholarship') }}" method="post">
                        @csrf
                        <div class="form-group row border-top pt-3">
                            <div class="col-md-6 text-md-right col-form-label">Уплати</div>

                            <div class="col-md-3 font-weight-bold">
                                <input class="form-control  @error('payment') is-invalid @enderror" type="number" name="payment" id="payment" placeholder="Унесите износ за уплату" required oninvalid="this.setCustomValidity('Унесите износ за уплату!')" oninput="setCustomValidity('')">
                            </div>

                            @error('payment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="offset-md-5">
                            <div class="offset-md-1">
                                <button type="submit" class="btn btn-success btn-sm">
                                    Изврши уплату
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="card mt-4">
                <div class="card-body text-center">Финансирате се из буџета</div>
            </div>
        @endif
    </div>

    <!-- Modal Update Scholarship Success Message -->
    <div class="modal" id="updateScholarship_success" tabindex="-1" aria-labelledby="updateScholarship_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Уплата успешно извршена.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Scholarship Failed Message -->
    <div class="modal" id="updateScholarship_failed" tabindex="-1" aria-labelledby="updateScholarship_failed" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Уплата неуспешна. Покушајте поново.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Scholarship No Money Message -->
    <div class="modal" id="updateScholarship_noMoney" tabindex="-1" aria-labelledby="updateScholarship_noMoney" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Немате довољно новчаних средстава на рачуну за уплату школарине.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Scholarship Success Message -->
    <div class="modal" id="updateScholarship_success2" tabindex="-1" aria-labelledby="updateScholarship_success2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Уплата школарине успешно извршена.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Scholarship Failed Message -->
    <div class="modal" id="updateScholarship_failed2" tabindex="-1" aria-labelledby="updateScholarship_failed2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Уплата школарине неуспешна. Покушајте поново.
                </div>
            </div>
        </div>
    </div>
@endsection
