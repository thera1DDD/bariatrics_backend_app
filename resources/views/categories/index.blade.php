@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        @include('layouts.errors')
        <!-- Table Element -->
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="mb-3">
                        <h6 style="font-size: 20px">Категории</h6>
                    </div>
                    <a href="routes/create" class="btn btn-outline-secondary"><i class="fas fa-plus-circle"></i> </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Название</th>
                            <th scope="col">Описание</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td data-th="Id">{{$category->id}}</td>
                                <td data-th="Имя">{{$category->name}}</td>
                                <td data-th="Описание">{{$category->description}}</td>
                                <td data-th="Действие"> <a href="{{route('category.edit',$category->id)}}" class="btn btn-outline-success"> <i class="fa fa-edit"></i></a>
                                    <form action="{{route('category.delete',$category->id) }}" method="post">
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
                    {{ $categories->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
