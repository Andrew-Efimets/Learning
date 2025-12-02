<form method="get" action="{{ route('products.index') }}" class="filter_wrapper">
    <div class="filter">
        <div class="filter_title_wrapper">
            <p class="filter_title">Фильтр</p>
        </div>
        <label for="select_category" class="category_label">Категории</label>
        <select class="filter_category" id="select_category" name="category_id">
            <option value="all" @if(request()->query('category_id') == 'all') selected @endif>
                Все категории
            </option>
            @foreach($categories as $category)
                <option
                    value="{{ $category->id }}"
                    @if(request()->query('category_id') == $category->id) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <label for="select_city" class="category_label">Город</label>
        <select class="filter_category" id="select_city" name="city_id">
            <option value="all" @if(request()->query('city_id') == 'all') selected @endif>
                Любой
            </option>
            @foreach($cities as $city)
                <option
                    value="{{ $city->id }}"
                    @if(request()->query('city_id') == $city->id) selected @endif>
                    {{ $city->city }}
                </option>
            @endforeach
        </select>
        <label class="price_from_wrapper" for="price_from">Цена от:</label>
        <input class="filter_category" type="text" name="price_from" id="price_from" value="{{ request('price_from') }}"
               min="0">
        <label class="price_to_wrapper" for="price_to">Цена до:</label>
        <input class="filter_category" type="text" name="price_to" id="price_to" value="{{ request('price_to') }}"
               min="0">
        <label class="check_photo_wrapper">
            <input class="checkbox" type="checkbox" name="photo_exist" value="1"
                   @if(request()->has('photo_exist')) checked @endif>
            Только с фотографиями
        </label>
    </div>
    <div class="button_wrapper_create">
        <button class="action_button" type="submit">Применить</button>
    </div>
</form>
