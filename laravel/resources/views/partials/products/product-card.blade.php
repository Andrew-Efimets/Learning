@if($product->isNotEmpty())
    <div class="products">
        @foreach($product as $item)
            <div class="product">
                @if($item->images->isNotEmpty())
                    <div class="product__image-wrapper">
                        <img class="product__image-item"
                             src="{{ asset('storage/product/'
                                . $item->created_at->format('Y/m')
                                . '/' . $item->id . '/' . $item->images->first()->product_image) }}"
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
                           href="{{ route('product_item.show', [$item->category, $item]) }}">
                            {{ $item->name }}
                        </a>
                    </div>
                    <div class="date__wrapper city__wrapper">
                        <p class="date city">
                            {{ $item->city?->city }}
                        </p>
                    </div>
                    <div class="date__wrapper city__wrapper">
                        <p class="date city">{{ $item->created_at->translatedFormat('d F, H:i') }}</p>
                    </div>
                </div>
                @if($item->user_id !== auth()->id())
                    <button
                        class="product__button {{ $item->is_in_cart ? 'in-cart' : 'add-to-cart' }}"
                        data-id="{{ $item->id }}"
                        {{ $item->is_in_cart ? 'disabled' : '' }}
                        style="{{ $item->is_in_cart ? 'background-color: #5b6559;' : '' }}"
                    >
                        {{ $item->is_in_cart ? 'В корзине ✓' : 'Оплатить на сайте' }}
                    </button>
                @else
                        <button class="product__button" disabled style="background-color: #5b6559">
                            Ваше объявление
                        </button>
                @endif
            </div>
        @endforeach
    </div>
@else
    <div class="nodata__container">
        <div class="nodata__wrapper">
            <img src="{{ asset('storage/images/nodata.png') }}" alt="Нет данных" class="nodata__img">
        </div>
        <p class="nodata__item">
            Ничего не найдено
        </p>
    </div>
@endif
