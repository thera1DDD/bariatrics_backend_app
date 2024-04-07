@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
    @include('layouts.errors')
        <!-- Table Element -->
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-3">
                        <h6 style="font-size: 20px">Приемы пищи</h6>
                    </div>
                    <a href="{{route('meal.create',$user->id)}}" class="btn btn-outline-secondary"><i class="fas fa-plus-circle"></i> </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Тип</th>
                            <th scope="col">Начало</th>
                            <th scope="col">Конец</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Дата</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($meals as $meal)
                            <tr>
                                <td data-th="Id">{{$meal->id}}</td>
                                <td data-th="Тип">{{ $mealTranslations[$meal->type] }}</td>
                                <td data-th="Начало">{{$meal->meal_start_at}}</td>
                                <td data-th="Конец">{{$meal->meal_end_at}}</td>
                                <td data-th="Статус">@if($meal->ate_at != null)Cъеден@else Не съеден@endif</td>
                                <td data-th="Дата">{{ \Carbon\Carbon::parse($meal->meal_end_at)->format('Y-m-d') }}</td>
                                <td data-th="Действие">
                                    <a href="{{route('meal.edit',$meal->id)}}" class="btn btn-outline-primary">+<i class="fa-solid fa-pizza-slice"></i></a>
                                    <form action="{{route('meal.delete',$meal->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button  type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                    <a href="{{route('meal.edit',$meal->id)}}" class="btn btn-outline-success"> <i class="fa fa-edit"></i></a>
                                    </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $meals->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
