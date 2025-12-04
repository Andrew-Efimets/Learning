@foreach(request()->except(['sort']) as $key => $value)
    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
@endforeach
<div class="sort">
    <label for="sort" class="sort__heading">Сортировать:</label>
    <select class="sort__field" id="sort" name="sort" onchange="this.form.submit();">
        <option value="created_at_desc" @if(request('sort') == 'created_at_desc') selected @endif >сначала новые
        </option>
        <option value="created_at_asc" @if(request('sort') == 'created_at_asc') selected @endif>сначала старые</option>
        <option value="price_asc" @if(request('sort') == 'price_asc') selected @endif>сначала дешевле</option>
        <option value="price_desc" @if(request('sort') == 'price_desc') selected @endif>сначала дороже</option>
        <option value="name_asc" @if(request('sort') == 'name_asc') selected @endif>по названию А-Я</option>
        <option value="name_desc" @if(request('sort') == 'name_desc') selected @endif>по названию Я-А</option>
    </select>
</div>

