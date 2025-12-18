<div class="products">
    @foreach($product as $item)
        <div class="product">
            @if($item->images->isNotEmpty())
                <div class="product__image-wrapper">
                    <img class="product__image-item"
                         src="{{ asset('storage/product/' . $item->id . '/' . $item->images->first()->product_image) }}"
                         alt="Изображение">
                </div>
            @else
                <div class="product__image-wrapper">
                    <div class="no__image">Photo</div>
                </div>
            @endif
            <div class="product__information">
                <div class="product__price-wrapper">
                    <p class="product__price">{{ $item->price }} р.</p>
                </div>
                <div class="product__name-wrapper">
                    <a class="product__name"
                       href="{{ route('product_item.show', ['category' => $item->category_id, 'product' => $item->id]) }}">
                        {{ $item->name }}
                    </a>
                </div>
                <div class="date__wrapper city__wrapper">
                    @foreach($cities as $city)
                        @if($item->city_id == $city->id)
                            <p class="date city">
                                {{ $city->city }}
                            </p>
                        @endif
                    @endforeach
                </div>
                <div class="date__wrapper city__wrapper">
                    <p class="date city">{{ $item->created_at->translatedFormat('d F, H:i') }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
