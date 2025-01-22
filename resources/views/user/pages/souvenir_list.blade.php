@include('user.includes.header')
<section class="py-4">
    <div class="container-fluid">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="col-12">
                <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-2">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" style="color: #af2910;">@if(Cookie::get('language') ==
                                    '2')घर
                                    @else
                                    Home
                                    @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                @if(Cookie::get('language') ==
                                '2')उत्पादों की सूची
                                @else
                                Product List
                                @endif</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Product List Section -->
<section class="py-4">
    <div class="container-fluid">

        <!-- Search Form -->
        <form id="search_frm" name="search_frm" method="get" action="">
            <div class="content-box mb-4">
                <h3>
                    @if(Cookie::get('language') ==
                    '2')उत्पादों को खोजना
                    @else
                    Search Products
                    @endif
                </h3>
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Keywords"> @if(Cookie::get('language') ==
                                '2')कीवर्ड:
                                @else
                                Keywords:
                                @endif
                            </label>
                            <input type="text" class="form-control" id="Keywords" name="keywords" value="{{$keywords}}"
                                placeholder="Search Products">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Products">
                                @if(Cookie::get('language') ==
                                '2')उत्पाद:
                                @else
                                Products:
                                @endif
                            </label>
                            <select name="pro_category" id="type" class="form-control">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('pro_category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Products">
                                @if(Cookie::get('language') ==
                                '2')उत्पाद का प्रकार:
                                @else
                                Product Type:
                                @endif
                            </label>
                            <select name="producttype" id="producttype" class="form-control">
                                <option value="">Select</option>
                                <option value="Sale" {{ request('producttype') == 'Sale' ? 'selected' : '' }}>Sale
                                </option>
                                <option value="Download" {{ request('producttype') == 'Download' ? 'selected' : '' }}>
                                    Download</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">

                        <button id="btn2" type="submit"
                            class="btn btn-outline-primary fw-bold w-100">@if(Cookie::get('language') ==
                            '2')जमा करना
                            @else
                            Submit
                            @endif</button>
                        <input type="hidden" name="action" value="submit">
                        <a href="{{ route('user.souvenir')}}" id="btn2" type="reset"
                            class="btn btn-outline-warning fw-bold w-100">
                            @if(Cookie::get('language') ==
                            '2')रीसेट करें
                            @else
                            Reset
                            @endif
                        </a>
                        <input type="hidden" name="action" value="reset">
                    </div>
                </div>
            </div>
        </form>

        <!-- Products Display -->
        <div class="row g-4">
            @if(count($souvenir) > 0)
            @foreach ($souvenir as $product)
            <div class="col-sm-6 col-lg-3 d-flex">
                <div class="card w-100 shadow-sm">
                    <div class="card-header text-truncate" style="border-bottom: 0;">
                        <h5 title="{{ $product->product_title }}">{{ Str::limit($product->product_title, 50, '...') }}
                        </h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <img src="{{ asset('AcademySouvenir/images/' . $product->upload_image) }}"
                            class="card-img-top img-fluid rounded" alt="{{ $product->product_title }}"
                            style="height: 200px; object-fit: cover;">
                        <p class="description mt-3 text-truncate">
                            <?php echo (Str::limit($product->product_description, 50, '...'));?></p>
                        @if ($product->product_type == 'Sale')
                        @php
                        // Calculate the discount percentage
                        $originalPrice = $product->product_price;
                        $discountedPrice = $product->product_discounted_price;
                        $discountPercentage = $originalPrice > 0 ? round((($originalPrice - $discountedPrice) /
                        $originalPrice) * 100, 2) : 0;
                        @endphp
                        @if($discountedPrice > 0)
                        <p class="price fw-bold text-primary">
                            <span>₹</span>
                            <del>{{ number_format($originalPrice, 2) }}</del>
                        </p>

                        <!-- Discounted Price -->
                        <p class="price fw-bold text-success">
                            <span>₹</span>
                            {{ number_format($originalPrice-$discountedPrice, 2) }}
                        </p>

                        <!-- Discount Percentage -->
                        <p class="discount text-danger">
                            Save {{ $discountPercentage }}%
                        </p>
                        @else
                        <p class="price fw-bold text-primary">
                            <span>₹</span>
                            {{ number_format($originalPrice, 2) }}
                        </p>
                        @endif
                        <p class="mt-auto small">
                            <span class="text-muted">For Purchase, kindly contact:</span><br>
                            <a href="mailto:{{ $product->contact_email_id }}">{{ $product->contact_email_id }}</a>
                        </p>
                        @elseif($product->product_type == 'Download')
                        <a href="{{ asset('AcademySouvenir/documents/' . $product->document_upload) }}"
                            target="_blank">Free Download</a>

                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div>No Result Found</div>
            @endif
        </div>
    </div>
</section>


@include('user.includes.footer')