@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        <div class="card border-0">
            <div class="card-body">
                <h6 style="font-size: 20px">Добавление приема пищи</h6>
                <br>
                <form action="{{ route('meal.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="day_id">День реабилитации</label>
                        <select name="day_id" id="day_id" class="form-control custom-input">
                            @foreach($days as $day)
                                <option value="{{ $day->id }}">{{ $day->day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Тип</label>
                        <select name="type" id="type" class="form-control custom-input">
                            <option value="breakfast">Завтрак</option>
                            <option value="second">Второе</option>
                            <option value="lunch">Обед</option>
                            <option value="midday">Полдник</option>
                            <option value="dinner">Ужин</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ate_at">Статус:</label>
                        <select name="ate_at" id="ate_at" class="form-control custom-input" required>
                            <option value="{{ now() }}">Съеден</option>
                            <option selected value="{{ null }}">Не съеден</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="meal_start_at">Начало приема пищи:</label>
                        <input type="text" id="meal_start_at" name="meal_start_at" class="form-control custom-input" required>
                    </div>
                    <div class="form-group">
                        <label for="meal_end_at">Конец приема пищи:</label>
                        <input type="text" id="meal_end_at" name="meal_end_at" class="form-control custom-input" required>
                    </div>
                    <input hidden="hidden" name="users_id" value="{{$user->id}}" >
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Создать</button>
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
