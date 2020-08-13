<div class="latest-section flex-wrap justify-content-center mb-5">
    <div class="row justify-content-between">
        @foreach($products as $product)
                <div class="card resize_card">

                    <div class="card-body p-0">
                        <figure>

                            @foreach($product->images as $image)
                                @if($image->is_main==1)
                                    <a href="{{route('view_details',$product->slug)}}"><img
                                                src="{{ asset($image->image) }}" alt="{{ $product->title }}"></a>
                                @endif
                            @endforeach

                        </figure>
                    </div>

                    <div class="card-footer">
                        <div class="special-product_name">
                            <a href="{{route('view_details',$product->slug)}}">
                                <span>{{ $product->title }}</span></a>
                        </div>
                        <div class="special-product_price">
                            <div class="text-left"><span>Rs.</span><span>
                                     @if($product->valid_special_price()==1)
                                        {{ $product->sale_price }}
                                    @else
                                        {{ $product->price }}
                                    @endif
                                         </span>
                            </div>
                            <div class="text-right"></div>

                        </div>
                        <div class="buttons">
                            <a href="{{route('add_cart',$product->id)}}" class="add_to_cart ">
                                <span><i class="icofont-basket"></i></span>

                                <span>Add to cart</span> </a>
                            <a href="{{route('postWishlist',$product->id)}}" class="add-to-wishlist">
                                <span><i class="icofont-heart-alt"
                                         uk-tooltip="title: Wishlist; pos: left"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
</div>