@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        @include('layouts.errors')
        <!-- Table Element -->
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-3">
                        <h6 style="font-size: 20px">Содержимые блюда</h6>
                    </div>
                   <div>
                       <a href="{{ route('meal.index',$meal->users_id) }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i></a>

                       <a href="{{route('mealProduct.create',$meal->id)}}" class="btn btn-outline-secondary"><i class="fas fa-plus-circle"></i> </a>
                   </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Название</th>
                            <th scope="col">Описание</th>
                            <th scope="col">Каллории</th>
                            <th scope="col">Грамм</th>
                            <th scope="col">Количество</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mealsProducts as $mealsProduct)
                            <tr>
                                <td data-th="Id">{{$mealsProduct->id}}</td>
                                <td data-th="Имя">{{$mealsProduct->food->name}}</td>
                                <td data-th="Описание">{{$mealsProduct->food->description}}</td>
                                <td data-th="Каллории">{{$mealsProduct->food->kkal}}</td>
                                <td data-th="Грамм">{{$mealsProduct->food->gram}}</td>
                                <td data-th="Количество">{{$mealsProduct->quantity}}</td>
                                <td data-th="Действие">
                                    <a href="{{route('mealsProduct.edit',$mealsProduct->id)}}" class="btn btn-outline-success"> <i class="fa fa-edit"></i></a>
                                    <form action="{{route('mealsProduct.delete',$mealsProduct->id) }}" method="post">
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
                    {{ $mealsProducts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
