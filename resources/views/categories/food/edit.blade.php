@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3">
                    <h6 style="font-size: 20px"> Редактирование Еды</h6>
                </div>
                @include('layouts.errors')
                <form action="{{ route('food.update', $food->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Название:</label>
                        <input type="text" name="name" id="name" class="form-control custom-input" required value="{{ $food->name }}" >
                    </div>
                    <div class="form-group">
                        <label for="description">Описание:</label>
                        <textarea name="description" id="description" class="form-control custom-input" rows="3" required>{{ $food->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="kkal">Каллории:</label>
                        <input type="text" name="kkal" id="name" class="form-control custom-input" required value="{{ $food->kkal }}" >
                    </div>
                    <div class="form-group">
                        <label for="gram">Грамм:</label>
                        <input type="text" name="gram" id="gram" class="form-control custom-input" required value="{{ $food->gram }}" >
                    </div>
                    <input hidden="hidden"  name="category_id" value="{{$food->category_id}}">
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Обновить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
