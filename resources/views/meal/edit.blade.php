@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">

        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3">
                    <h6 style="font-size: 20px" > Редактирование приема пищи</h6>
                </div>
                <form action="{{ route('meal.update', $meal->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="type">Тип:</label>
                        <select name="type" id="type" class="form-control custom-input">
                            <option value="breakfast" {{ $meal->type == 'breakfast' ? 'selected' : '' }}> Завтрак</option>
                            <option value="second" {{ $meal->type == 'second' ? 'selected' : '' }}> Второе</option>
                            <option value="lunch" {{ $meal->type == 'lunch' ? 'selected' : '' }}> Обед</option>
                            <option value="midday" {{ $meal->type == 'midday' ? 'selected' : '' }}> Полдник</option>
                            <option value="dinner" {{ $meal->type == 'dinner' ? 'selected' : '' }}> Ужин</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ate_at">Статус:</label>
                        <select name="ate_at" id="ate_at" class="form-control custom-input">
                            <option value="{{null}}" {{ $meal->ate_at == null ? 'selected' : '' }}>Не съедено</option>
                            <option  value="{{now()}}" {{ $meal->ate_at !== null ? 'selected' : '' }}>Cъедено</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="meal_start_at">Начало приема пищи:</label>
                        <input type="text" id="meal_start_at" value="{{$meal->meal_start_at}}"  name="meal_start_at" class="form-control custom-input" required>
                    </div>
                    <div class="form-group">
                        <label for="meal_end_at">Конец приема пищи:</label>
                        <input type="text" id="meal_end_at" name="meal_end_at" value="{{$meal->meal_end_at}}" class="form-control custom-input" required>
                    </div>
                    <input hidden="hidden" name="users_id" value="{{$meal->users_id}}" >
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Обновить маршрут</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
<script>
    $(function() {
        $('#meal_start_at').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 15,
            locale: {
                format: 'YYYY-MM-DD HH:mm'
            }
        });
    });

    $(function() {
        $('#meal_end_at').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 15,
            locale: {
                format: 'YYYY-MM-DD HH:mm'
            }
        });
    });
</script>

