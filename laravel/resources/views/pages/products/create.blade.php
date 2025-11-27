@extends('layouts.app')
@section('title', 'Подача объявления')

@section('content')
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="form_wrapper">
        @csrf
        <div class="create_wrapper">
            <label class="label_create" for="category_id">Категория</label>
            <div class="input_create_wrapper">
                <select class="select_create" name="category_id" type="text" id="category_id">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <label class="label_create" for="name">Название товара</label>
            <div class="input_create_wrapper">
                <input class="input_create" name="name" type="text" id="name">
            </div>
            <label class="label_create" for="price">Цена</label>
            <div class="input_create_wrapper">
                <input class="input_create" name="price" type="text" id="price">
            </div>
            <label class="label_create" for="description">Краткое описание</label>
            <div class="input_create_wrapper">
                <textarea class="textarea_create" name="description" type="text" id="description"></textarea>
            </div>
            <div class="input_photo_wrapper">
            <input class="input_photo" name="product_image[]" type="file" multiple="multiple" id="input_photo">
                <label for="input_photo" class="label_input_photo">
                    Выберите фотографии
                </label>
            </div>
            <div class="button_wrapper_create">
                <button class="action_button" type="submit">Подать объявление</button>
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
