@extends('layouts.sidebar')

@section('content')
    <div class="container-fluid">
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3">
                    <h6 style="font-size: 20px"> Редактирование Еды</h6>
                </div>
                @include('layouts.errors')
                <form action="{{ route('mealsProduct.update', $mealsProduct->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="categories">Категория</label>
                        <select  name="categories"  id="categories"  class="form-control custom-input"  style="width: 100%;">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $mealsProduct->food->category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach()
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="categories">Блюдо</label>
                        <select  name="foods_id"  id="foods_id"   class="form-control custom-input"  style="width: 100%;">
                                <option value="{{$mealsProduct->food->id}}">
                                        {{$mealsProduct->food->name}}
                                </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Количество:</label>
                        <input name="quantity" id="quantity" class="form-control custom-input" value="{{ $mealsProduct->quantity }}"  required>
                    </div>
                    <label>
                        <input hidden="hidden"  name="meals_id" value="{{$mealsProduct->meals_id}}">
                    </label>
                    <br>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary">Обновить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categories').on('change', function() {
            var category_id = $(this).val();
            $.ajax({
                url: '{{ route("mealsProduct.by.category", ":category_id") }}'.replace(':category_id', category_id),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var options = '';
                    $.each(data, function(index, mealsFood) {
                        options += '<option value="' + mealsFood.id + '">' + mealsFood.name + '</option>';
                    });
                    $('#foods_id').html(options);
                }
            });
        });
    });
</script>
