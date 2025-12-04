<div class="left-side__wrapper">
    <div class="heading__container">
        <p class="heading">
            Категории
        </p>
    </div>
    @foreach($categories as $category)
        <div class="category__wrapper">
            <a class="category"
               href="{{ route('category.show', $category->id) }}">{{$category->name}}</a>
        </div>
    @endforeach
    @include('partials.products.filter')
</div>
