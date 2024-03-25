@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        @include('layouts.errors')
        <!-- Table Element -->
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-3">
                        <h6 style="font-size: 20px">Пользователи</h6>
                    </div>
                    <a href="routes/create" class="btn btn-outline-secondary"><i class="fas fa-plus-circle"></i> </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Фамилия</th>
                            <th scope="col">Отчество</th>
                            <th scope="col">Дней после операции</th>
                            <th scope="col">Вес</th>
                            <th scope="col">Возраст</th>
                            <th scope="col">Номер телефона</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td data-th="Id">{{$user->id}}</td>
{{--                                <td data-th="Тип">{{$user->route_type == 'sender' ? 'Отправлю' : 'Перевезу'}}</td>--}}
                                <td data-th="Описание">{{$user->name}}</td>
                                <td data-th="Цена">{{$user->surname}}</td>
                                <td data-th="Откуда">{{$user->patronymic}}</td>
                                <td data-th="Куда">{{$user->surgery_date}}</td>
                                <td data-th="Начало">{{$user->weight}}</td>
                                <td data-th="Конец">{{$user->age}}</td>
                                <td data-th="Тип груза">{{$user->phone_number}}</td>
                                <td data-th="Размер груза">{{$user->water->achieved_at}}</td>
{{--                                <td data-th="Действие"> <a href="{{route('water.edit',$user->id)}}" class="btn btn-outline-success"> <i class="fa fa-edit"></i></a>--}}
{{--                                    <form action="{{route('wate.delete',$user->id) }}" method="post">--}}
{{--                                        @csrf--}}
{{--                                        @method('delete')--}}

{{--                                        <button  type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>--}}
{{--                                    </form>--}}
{{--                                </td>--}}
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
