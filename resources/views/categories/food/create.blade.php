@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        <div class="mb-3">

        </div>

        <div class="card border-0">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4>Добавление Еды</h4>
                <br>
                <form action="{{ route('food.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Название:</label>
                        <input type="text" name="name" id="name" class="form-control custom-input" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание:</label>
                        <textarea name="description" id="description" class="form-control custom-input" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kkal">Каллории:</label>
                        <input name="kkal" id="kkal" class="form-control custom-input" required>
                    </div>
                    <div class="form-group">
                        <label for="gram">Грамм:</label>
                        <input name="gram" id="gram" class="form-control custom-input"  required>
                    </div>
                    <input hidden="hidden"  name="category_id" value="{{$category->id}}">
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
