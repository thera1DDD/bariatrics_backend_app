@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        @include('layouts.errors')
        <!-- Table Element -->
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-3">
                        <h6 style="font-size: 20px">Расписание пациента {{$user->name}}</h6>
                    </div>
                    <form action="{{ route('stepList.search') }}" method="GET">
                        <div class="form-group">
                            <label for="date">День</label>
                            <div class="input-group date" id="datepicker">
                                <input type="text"  name="date" class="form-control custom-input">
                                <span class="input-group-append"></span>
                            </div>
                            <input type="text" hidden="hidden" name="users_id" value="{{$user->id}}">
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary">Поиск</button>
                        </div>
                    </form>
                    <a href="{{route('stepDay.create',$user->id)}}" class="btn btn-outline-secondary"><i class="fas fa-plus-circle"></i> </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Цель</th>
                            <th scope="col">Текущий результат</th>
                            <th scope="col">Каллории</th>
                            <th scope="col">Дистанция</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Дата</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($steps as $step)
                            <tr style="font-size: 15px">
                                <td data-th="Id">{{$step->id}}</td>
{{--                                <td data-th="Тип">{{$step->route_type == 'sender' ? 'Отправлю' : 'Перевезу'}}</td>--}}
                                <td data-th="Цель">{{$step->goal}}</td>
                                <td data-th="Текущий резуальтат">{{$step->current}}</td>
                                <td data-th="Каллории">{{$step->kkal}}</td>
                                <td data-th="Дистанция">{{$step->distance}}</td>
                                <td data-th="Статус">@if($step->achieved_at != null)Прошёл@else Не прошёл @endif</td>
                                <td data-th="Дата">{{$step->date}}</td>
                                <td data-th="Действие"> <a href="{{route('stepDays.edit',$step->id)}}"  class="btn btn-outline-success">  <i class="fas fa-edit"></i></a>
                                    <form action="{{route('stepDay.delete',$step->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button  type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $steps->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
        });
    });
</script>
