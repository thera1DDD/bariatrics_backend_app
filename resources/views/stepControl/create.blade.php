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
                <h6 style="font-size: 22px">Создание дня</h6>
                <br>
                <form action="{{ route('stepDay.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="goal">Цель:</label>
                        <input type="text" name="goal" id="goal" class="form-control custom-input" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="current">Текущее значение:</label>
                        <input name="current" id="current" class="form-control custom-input"  required>
                    </div>
                    <div class="form-group">
                        <label for="kkal">Каллории:</label>
                        <input name="kkal" id="kkal" class="form-control custom-input"  required>
                    </div>
                    <div class="form-group">
                        <label for="distance">Дистанция:</label>
                        <input name="distance" id="distance" class="form-control custom-input"  required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="achieved_at">Статус:</label>
                        <select name="achieved_at" id="achieved_at" class="form-control custom-input" required>
                            <option value="{{now()}}">Прошёл</option>
                            <option value="{{null}}">Не прошёл</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="date">День</label>
                        <div class="input-group date" id="datepicker">
                            <input type="text"  name="date" class="form-control custom-input">
                            <span class="input-group-append">
                        </span>
                        </div>
                    </div>
                    <label hidden="hidden">
                        <input hidden="hidden" name="users_id" value="{{$users_id}}" >
                    </label>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
        });
    });
</script>
