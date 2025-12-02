<div class="products">
    @foreach($product as $item)
        <div class="product">
            @foreach($productImages as $image)
                @if($item->id == $image->product_id)
                    <div class="product_image_wrapper">
                        <img class="product_image_item"
                             src="{{ asset('storage/product/' . $item->id . '/' . $image->product_image) }}"
                             alt="Изображение">
                    </div>
                    @break
                @endif
            @endforeach
            @if($item->id !== $image->product_id)
                <div class="product_image_wrapper">
                    <div class="no_image">
                        Photo
                    </div>
                </div>
            @endif
            <div class="product_information">
                <div class="product_price_wrapper">
                    <p class="product_price">{{$item->price}} р.</p>
                </div>
                <div class="product_name_wrapper">
                    <a class="product_name"
                       href="{{route('product_item.show', ['category_id' => $item->category_id, 'id' => $item->id])}}">
                        {{$item->name}}
                    </a>
                </div>
                <div class="date_wrapper">
                    @foreach($cities as $city)
                        @if($item->city_id == $city->id)
                            <p class="date">
                                {{ $city->city }}
                            </p>
                        @endif
                    @endforeach
                </div>
                <div class="date_wrapper">
                    <p class="date">{{$item->created_at->translatedFormat('d F, H:i')}}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
