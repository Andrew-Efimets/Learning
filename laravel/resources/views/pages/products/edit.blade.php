@extends('layouts.app')
@section('title', $product->name)

@section('content')

    <form method="POST" action="{{ route('products.update', $product) }}"
          enctype="multipart/form-data"
          class="form__container">
        @csrf
        @method('PATCH')
        <div class="form__wrapper">
            <label class="field__heading" for="category_id">Категория</label>
            <div class="field__wrapper">
                <select class="field" name="category_id" type="text" id="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected($category == $product->category)>
                            {{ $category->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <label class="field__heading" for="city_id">Город</label>
            <div class="field__wrapper">
                <select class="field select2" name="city_id" id="city_id">
                    <option value=""></option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" @selected($city == $product->city)>
                            {{ $city->city }}
                        </option>
                    @endforeach
                </select>
            </div>
            <label class="field__heading" for="name">Название товара</label>
            <div class="field__wrapper">
                <input class="field @error('name') field__error @enderror" name="name" type="text"
                       value="{{ $product->name }}" id="name">
            </div>
            @error('name')
            <span class="field__error-message">Название товара обязательно</span>
            @enderror
            <label class="field__heading" for="price">Цена</label>
            <div class="field__wrapper">
                <input class="field @error('price') field__error @enderror" name="price" type="text"
                       value="{{ $product->price }}" id="price">
            </div>
            @error('price')
            <span class="field__error-message">Цена товара обязательна</span>
            @enderror
            <label class="field__heading" for="description">Краткое описание</label>
            <div class="field__wrapper">
                <textarea class="textarea @error('description') field__error @enderror" name="description" type="text"
                          id="description">{{ $product->description }}</textarea>
            </div>
            @error('description')
            <span class="field__error-message">Добавьте описание товара</span>
            @enderror
            <label class="field__heading">Текущие фотографии</label>
            <div class="field__current-photos">
                @foreach($product->images as $image)
                    <div class="preview__item" id="old-photo-container-{{ $image->id }}">
                        <img class="preview__img" alt=""
                             src="{{ asset('storage/product/'
                                . $product->created_at->format('Y/m')
                                . '/' . $product->id . '/' . $image->product_image) }}">
                        <span class="preview__remove old-remove" data-id="{{ $image->id }}">&times;</span>
                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"
                               id="delete_photo_{{ $image->id }}" style="display: none;">
                    </div>
                @endforeach
            </div>
            <div id="new-preview-container" class="preview__container"></div>
            <div class="button__wrapper">
                <input class="button__input-photo" name="product_image[]" type="file" multiple="multiple"
                       id="input_photo">
                <label for="input_photo" class="button">
                    Добавить новые фотографии
                </label>
            </div>
            <div class="button__wrapper">
                <button class="button" type="submit">Сохранить изменения</button>
            </div>
        </div>
    </form>
    @can('delete', $product)
        <form method="POST" action="{{ route('products.destroy', $product) }}"
              class="form__wrapper">
            @csrf
            @method('DELETE')
            <button class="button" type="submit">Удалить объявление</button>
        </form>
    @endcan
@endsection
