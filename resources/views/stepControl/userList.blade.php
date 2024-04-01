@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        @include('layouts.errors')
        <!-- Table Element -->

        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-3">
                        <h6 style="font-size: 20px">Контроль Шагов </h6>
                    </div>
                    <form action="{{ route('userList.search.step') }}" method="GET">
                        <div class="form-group">
                            <div class="mb-2">
                                <input type="text" name="search" class="form-control" placeholder="Поиск">
                            </div>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary">Поиск</button>

                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Фамилия</th>
                            <th scope="col">Отчество</th>
                            <th scope="col">Вес</th>
                            <th scope="col">Возраст</th>
                            <th scope="col">Пол</th>
{{--                            <th scope="col">Статус</th>--}}
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr style="font-size: 17px">
                                <td data-th="Id">{{$user->id}}</td>
{{--                                <td data-th="Тип">{{$user->route_type == 'sender' ? 'Отправлю' : 'Перевезу'}}</td>--}}
                                <td data-th="Имя">{{$user->name}}</td>
                                <td data-th="Фамилия">{{$user->surname}}</td>
                                <td data-th="Отчество">{{$user->patronymic}}</td>
                                <td data-th="Вес">{{$user->weight}}</td>
                                <td data-th="Возраст">{{$user->age}}</td>
                                <td style="font-size: 25px" data-th="Пол">@if($user->gender == 'male' or $user->gender == null) 🧔🏻‍@else 👩🏻‍🦰 @endif</td>
                                <td data-th="Действие"> <a style="width: 134px" href="{{route('stepDays.show',$user->id)}}"  class="btn btn-outline-success">  <i class="fas fa-calendar"></i> Расписание</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $users->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
