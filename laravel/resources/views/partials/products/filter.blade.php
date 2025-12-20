<form method="get" action="{{ route('home') }}" class="filter__wrapper">
    <div class="filter">
        <div class="heading__container">
            <p class="heading">Фильтр</p>
        </div>
        <label for="select_category" class="sort__heading">Категории</label>
        <select class="sort__field" id="select_category" name="category_id">
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
        <label for="select_city" class="sort__heading">Город</label>
        <select class="sort__field" id="select_city" name="city_id">
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
        <label class="sort__heading" for="price_from">Цена от:</label>
        <input class="sort__field" type="text" name="price_from" id="price_from" value="{{ request('price_from') }}"
               min="0">
        <label class="sort__heading" for="price_to">Цена до:</label>
        <input class="sort__field" type="text" name="price_to" id="price_to" value="{{ request('price_to') }}"
               min="0">
        <label class="check-photo__wrapper">
            <input class="checkbox" type="checkbox" name="photo_exist" value="1"
                   @if(request()->has('photo_exist')) checked @endif>
            Только с фотографиями
        </label>
        <div class="button__wrapper">
            <button class="button" type="submit">Применить</button>
        </div>
    </div>
</form>
