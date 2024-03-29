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
                    <a href="{{route('waterDay.create')}}" class="btn btn-outline-secondary"><i class="fas fa-plus-circle"></i> </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Цель</th>
                            <th scope="col">Текущий результат</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Дата</th>
{{--                            <th scope="col">Статус</th>--}}
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($waters as $water)
                            <tr style="font-size: 15px">
                                <td data-th="Id">{{$water->id}}</td>
{{--                                <td data-th="Тип">{{$water->route_type == 'sender' ? 'Отправлю' : 'Перевезу'}}</td>--}}
                                <td data-th="Цель">{{$water->goal}}</td>
                                <td data-th="Текущий резуальтат">{{$water->current}}</td>
                                <td data-th="Статус">@if($water->achieved_at != null)Выпил@else Не выпил @endif</td>
                                <td data-th="Дата">{{$water->date}}</td>
                                <td data-th="Действие"> <a href="{{route('waterDays.edit',$water->id)}}"  class="btn btn-outline-success">  <i class="fas fa-edit"></i></a>
                                    <form action="{{route('waterDays.delete',$water->id) }}" method="post">
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
                    {{ $waters->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
