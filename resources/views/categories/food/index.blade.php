@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        @include('layouts.errors')
        <!-- Table Element -->
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-3">
                        <h6 style="font-size: 20px">Еда</h6>
                    </div>
                    <a href="{{route('food.create',$category->id)}}" class="btn btn-outline-secondary"><i class="fas fa-plus-circle"></i> </a>
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
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($foods as $food)
                            <tr>
                                <td data-th="Id">{{$food->id}}</td>
                                <td data-th="Имя">{{$food->name}}</td>
                                <td data-th="Описание">{{$food->description}}</td>
                                <td data-th="Каллории">{{$food->kkal}}</td>
                                <td data-th="Грамм">{{$food->gram}}</td>
                                <td data-th="Действие">
                                    <a href="{{route('food.edit',$food->id)}}" class="btn btn-outline-success"> <i class="fa fa-edit"></i></a>
                                    <form action="{{route('food.delete',$food->id) }}" method="post">
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
                    {{ $foods->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
