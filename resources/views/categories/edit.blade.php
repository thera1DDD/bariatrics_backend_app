@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3">
                    <h6 style="font-size: 20px"> Редактирование Категории</h6>
                </div>
                @include('layouts.errors')
                <form action="{{ route('category.update', $category->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Имя:</label>
                        <input type="text" name="name" id="name" class="form-control custom-input" required value="{{ $category->name }}" >
                    </div>
                    <div class="form-group">
                        <label for="description">Описание:</label>
                        <textarea name="description" id="description" class="form-control custom-input" rows="3" required>{{ $category->description }}</textarea>
                    </div>

                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Обновить Категорию</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
