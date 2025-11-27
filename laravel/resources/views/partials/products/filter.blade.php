<form method="get" action="{{ route('products.index') }}" class="filter_wrapper">
    <div class="filter">
        <div class="filter_title_wrapper">
            <p class="filter_title">Фильтр</p>
        </div>
        <label for="select_category" class="category_label">Категории</label>
        <select class="filter_category" id="select_category" name="category_id">
            <option value="all" selected>Все категории</option>
            @foreach($categories as $category)
                <option
                    value="{{ $category->id }}">{{$category->name}}</option>
            @endforeach
        </select>
        <label class="price_from_wrapper" for="price_from">Цена от:</label>
        <input class="filter_category" type="text" name="price_from" id="price_from" value="{{ request('price_from') }}" min="0">
        <label class="price_to_wrapper" for="price_to">Цена до:</label>
        <input class="filter_category" type="text" name="price_to" id="price_to" value="{{ request('price_to') }}" min="0">
        <label class="check_photo_wrapper">
            <input class="checkbox" type="checkbox" name="photo_exist" value="1">
            Только с фотографиями
        </label>
    </div>
    <div class="button_wrapper_create">
        <button class="action_button" type="submit">Применить</button>
    </div>
</form>
