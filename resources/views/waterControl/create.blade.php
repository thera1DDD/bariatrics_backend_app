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
                <h4>Добавление дня</h4>
                <br>
                <form action="{{ route('routing.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="route_type">Тип:</label>
                        <select name="route_type" id="route_type" class="form-control custom-input" required>
                            <option value="carrier">Отправка</option>
                            <option value="sender">Перевозка</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Цель:</label>
                        <input type="text" name="goal" id="goal" class="form-control custom-input" required>
                    </div>

                    <div class="form-group">
                        <label for="current">Текущее значение:</label>
                        <input name="current" id="current" class="form-control custom-input"  required>>
                    </div>

                    <div class="form-group">
                        <label for="datepicker">Дата:</label>
                        <input type="text" id="datepicker" name="date" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Создать маршрут</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.datePicker')
@endsection
