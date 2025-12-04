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
                <input class="field" name="name" type="text" id="name">
            </div>
            <label class="field__heading" for="price">Цена</label>
            <div class="field__wrapper">
                <input class="field" name="price" type="text" id="price">
            </div>
            <label class="field__heading" for="description">Краткое описание</label>
            <div class="field__wrapper">
                <textarea class="textarea" name="description" type="text" id="description"></textarea>
            </div>
            <div class="input-photo__wrapper">
            <input class="input-photo" name="product_image[]" type="file" multiple="multiple" id="input_photo">
                <label for="input_photo" class="input-photo__heading">
                    Выберите фотографии
                </label>
            </div>
            <div class="button__wrapper">
                <button class="button" type="submit">Подать объявление</button>
            </div>
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </form>
@endsection
