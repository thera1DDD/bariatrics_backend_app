@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3">
                    <h6 style="font-size: 20px"> Редактирование дня пациента</h6>
                </div>
                @include('layouts.errors')
                <form action="{{ route('waterDay.update', $waterDay->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Цель:</label>
                        <input type="text" name="goal"  class="form-control custom-input" required value="{{ $waterDay->goal }}" >
                    </div>
                    <div class="form-group">
                        <label for="current">Текущее значение:</label>
                        <input name="current" id="current" class="form-control custom-input" required value="{{ $waterDay->current }}">
                    </div>
                    <div class="form-group">
                        <label for="achieved_at">Статус:</label>
                        <select name="achieved_at" id="achieved_at" class="form-control custom-input">
                            <option value="{{null}}" {{ $waterDay->achieved_at == null ? 'selected' : '' }}>Не выпил</option>
                            <option  value="{{now()}}" {{ $waterDay->achieved_at !== null ? 'selected' : '' }}>Выпил</option>
                        </select>
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <label for="price"></label>--}}
{{--                        <input type="text" name="price" id="price" class="form-control custom-input" value="{{ $waterDay->price }}" required>--}}
{{--                    </div>--}}
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Обновить маршрут</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
