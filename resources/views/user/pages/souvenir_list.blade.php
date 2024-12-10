@include('user.includes.header')
<section class="py-4">
    <div class="container">
        <div class="row align-items-center pb-lg-2">
            <!-- Breadcrumb -->
            <div class="mb-4 mb-lg-0 bg-gray-200 rounded-4 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" style="color: #af2910;">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #af2910;">Product List</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>


<!-- Product List Section -->

<section class="py-4">
    <div class="container">

        <!-- Search Form -->
        <form class="form-inline" id="search_frm" name="search_frm" method="get" action="">
            <div class="col-md-12 content-box">
                <h3>Search Products</h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label for="Keywords">Keywords:</label>
                            <input type="text" class="form-control" id="Keywords" name="keywords" value=""
                                placeholder="Search Products">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label for="Products">Products:</label>
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
                        <div class="form-group mb-4">
                            <label for="Products">Product Type:</label>
                            <select name="producttype" id="producttype" class="form-control">
                                <option value="">Select</option>
                                <option value="1" {{ request('producttype') == 1 ? 'selected' : '' }}>Sale</option>
                                <option value="2" {{ request('producttype') == 2 ? 'selected' : '' }}>Download</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for=""></label>
                            <input type="submit" name="submit" class="btn btn-outline-primary btn-sm"
                                style="margin-top: 25px;" value="Submit">
                            <input type="hidden" name="action" value="submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Products Display -->
        <div class="row">
            @foreach ($souvenir as $product)
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card mb-4">
                    <div class="card-header" style="border-bottom:0;">
                        <h3 title="{{ $product->product_title }}">{{ Str::limit($product->product_title, 20, '...') }}
                        </h3>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <img src="{{ asset('AcademySouvenir/images/' . $product->upload_image) }}"
                            class="img-responsive img-fluid" alt="{{ $product->product_title }}" style="height:300px; width:auto;object-fit:cover;">
                        <p class="description">{{ Str::limit($product->product_description, 30, '...') }}</p>
                        <p class="price"><span>₹</span> {{ $product->product_price }}</p>
                        <p>
                            <span>For Purchase, kindly contact:</span>
                            {{ $product->contact_email_id }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@include('user.includes.footer')