@extends('layouts.app')
@section('title', $product->name)

@section('content')

    <form method="POST" action="{{ route('products.update', ['product' => $product->id]) }}" enctype="multipart/form-data"
          class="form__container">
        @csrf
        @method('PATCH')
        <div class="form__wrapper">
            <label class="field__heading" for="category_id">Категория</label>
            <div class="field__wrapper">
                <select class="field" name="category_id" type="text" id="category_id">
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}" @selected($category->id == $product->category_id)>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <label class="field__heading" for="city_id">Город</label>
            <div class="field__wrapper">
                <select class="field" name="city_id" type="text" id="city_id">
                    @foreach($cities as $city)
                        <option
                            value="{{ $city->id }}" @selected($city->id == $product->city_id)>{{$city->city}}</option>
                    @endforeach
                </select>
            </div>
            <label class="field__heading" for="name">Название товара</label>
            <div class="field__wrapper">
                <input class="field" name="name" type="text" value="{{ $product->name }}" id="name">
            </div>
            <label class="field__heading" for="price">Цена</label>
            <div class="field__wrapper">
                <input class="field" name="price" type="text" value="{{ $product->price }}" id="price">
            </div>
            <label class="field__heading" for="description">Краткое описание</label>
            <div class="field__wrapper">
                <textarea class="textarea" name="description" type="text" id="description">{{ $product->description }}</textarea>
            </div>


            <div class="form__wrapper">
                <label class="field__heading">Текущие фотографии</label>
                <div class="current-photos" style="display: flex; gap: 10px; margin-bottom: 15px;">
                    @foreach($product->images as $image)
                        <div class="photo-item">
                            <img alt="" src="{{ asset('storage/product/' . $product->id . '/' . $image->product_image) }}"
                                 style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">

                            <div style="margin-top: 5px; text-align: center;">
                                <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="photo_{{ $image->id }}">
                                <label for="photo_{{ $image->id }}" style="font-size: 12px; cursor: pointer;">
                                    Удалить
                                </label>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="input-photo__wrapper">
                    <input class="input-photo" name="product_image[]" type="file" multiple="multiple" id="input_photo">
                    <label for="input_photo" class="input-photo__heading">
                        Добавить новые фотографии
                    </label>
                </div>
            </div>

{{--            <div class="input-photo__wrapper">--}}
{{--                <input class="input-photo" name="product_image[]" type="file" multiple="multiple" id="input_photo">--}}
{{--                <label for="input_photo" class="input-photo__heading">--}}
{{--                    Выберите фотографии--}}
{{--                </label>--}}
{{--            </div>--}}

            <div class="button__wrapper">
                <button class="button" type="submit">Сохранить изменения</button>
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
    @can('delete', $product)
        <div class="form__container">
            <form method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}" class="button__wrapper">
                @csrf
                @method('DELETE')
                <button class="button" type="submit">Удалить объявление</button>
            </form>
        </div>
    @endcan
@endsection
