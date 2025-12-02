<div class="category_wrapper">
    <div class="category_title">
        <p class="category_title_item">
            Категории
        </p>
    </div>
    @foreach($categories as $category)
        <div class="category_item_wrapper">
            <a class="category_item"
               href="{{ route('category.show', $category->id) }}">{{$category->name}}</a>
        </div>
    @endforeach
    @include('partials.products.filter')
</div>
