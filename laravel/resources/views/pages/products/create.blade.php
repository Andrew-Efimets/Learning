@extends('layouts.app')
@section('title', 'Подача объявления')

@section('content')
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="form__container">
        @csrf
        <div class="form__wrapper">
            <label class="field__heading" for="category_id">Категория</label>
            <div class="field__wrapper">
                <select class="field" name="category_id" type="text" id="category_id">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <label class="field__heading" for="city_id">Город</label>
            <div class="field__wrapper">
                <select class="field" name="city_id" type="text" id="city_id">
                    @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->city}}</option>
                    @endforeach
                </select>
            </div>

            <label class="field__heading" for="name">Название товара</label>

            <div class="field__wrapper">
                <input class="field @error('name') field__error @enderror" name="name" type="text" id="name">
            </div>
            @error('name')
            <span class="field__error-message">Название товара обязательно</span>
            @enderror
            <label class="field__heading" for="price">Цена</label>

            <div class="field__wrapper">
                <input class="field @error('price') field__error @enderror" name="price" type="text" id="price">
            </div>
            @error('price')
            <span class="field__error-message">Цена товара обязательна</span>
            @enderror
            <label class="field__heading" for="description">Краткое описание</label>
            <div class="field__wrapper">
                <textarea class="textarea @error('description') field__error @enderror" name="description"
                          type="text" id="description"></textarea>
            </div>
            @error('description')
            <span class="field__error-message">Добавьте описание товара</span>
            @enderror
            <div class="button__wrapper">
            <input class="button__input-photo" name="product_image[]" type="file" multiple="multiple" id="input_photo">
                <label for="input_photo" class="button">
                    Выберите фотографии
                </label>
            </div>
            <div class="button__wrapper">
                <button class="button" type="submit">Подать объявление</button>
            </div>
        </div>
    </form>
@endsection
