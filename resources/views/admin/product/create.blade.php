@extends('layouts.backendapp')

@section('content')

    @php
        // Configure this page
        $pageName = 'Create Product';

        $breadcrumbs = [
            ['title' => 'Dashboard', 'link' => '#', 'isActive' => ''],
            ['title' => 'Product', 'link' => '#', 'isActive' => ''],
            ['title' => 'Create', 'link' => '#', 'isActive' => 'active'],
        ];
        $currencyName = siteSettings('site_currency');
    @endphp


    <form action="{{ route('product.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
        @csrf
    <div class="px-5 col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

                    <div class="form-group row">
                        <label for="titleInput" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" class="form-control" value="" id="titleInput"
                                placeholder="Name">
                            @error('title')
                                <span class="text-danger">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="short_descInput" class="col-sm-3 col-form-label">Short Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="short_desc" id="short_descInput" rows="4"></textarea>
                            @error('short_desc')
                                <span class="text-danger ">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea name="content" rows="4" id="content"></textarea>
                            <script>
                                // Initialize CKEditor
                                ClassicEditor
                                    .create(document.getElementById('content'))
                                    .then(editor => {
                                        console.log('Editor was initialized', editor);
                                    })
                                    .catch(error => {
                                        console.error('Error during initialization of the editor', error);
                                    });
                            </script>
                            @error('content')
                                <span class="text-danger ">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="regular_priceInput" class="col-sm-3 col-form-label">Regular Price</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ $currencyName }}</span>
                                </div>
                                <input type="text" name="regular_price" class="form-control" id="regular_priceInput"
                                    placeholder="Regular Price" aria-label="Regular Price" aria-describedby="basic-addon1">
                            </div>
                            @error('regular_price')
                                <span class="text-danger ">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="sale_priceInput" class="col-sm-3 col-form-label">Sale Price</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ $currencyName }}</span>
                                </div>
                                <input type="text" name="sale_price" class="form-control" id="sale_priceInput"
                                    placeholder="Sale Price" aria-label="Sale Price" aria-describedby="basic-addon1">
                            </div>
                            @error('sale_price')
                                <span class="text-danger ">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>



                    <div class="form-group row ">
                        <label for="sale_priceInput" class="col-sm-3 col-form-label">Product Points</label>
                        <div class="col-sm-9">
                            <div class="input-group">

                                <input type="number" name="points" class="form-control" id="sale_priceInput"
                                    placeholder="Product Points" aria-label="Sale Price" aria-describedby="basic-addon1">
                            </div>
                            @error('points')
                                <span class="text-danger ">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="sale_priceInput" class="col-sm-3 col-form-label"> Points for website share</label>
                        <div class="col-sm-9">
                            <div class="input-group">

                                <input type="number" name="web_points" class="form-control" id="web_points"
                                    placeholder="Product Points for website share" aria-label="Sale Price" aria-describedby="basic-addon1">
                            </div>
                            @error('web_points')
                                <span class="text-danger ">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="prod_featuredInput" class="col-sm-3 col-form-label">Featured Product</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" id="prod_featured" name="prod_featured" value="1"
                                            class="form-check-input">Featured Product</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="prod_new_arrivalInput" class="col-sm-3 col-form-label">New Arrival</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" id="prod_new_arrival" name="prod_new_arrival" value="1"
                                            class="form-check-input">New Arrival</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="short_descInput" class="col-sm-3 col-form-label">Featured Image</label>
                        <div class="col-sm-6">
                            <input type="file" name="image" id="image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="py-3 file-upload-browse btn btn-gradient-primary"
                                        type="button">Upload</button>
                                    Note: size: 550px by 550px
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-3"> </div>

                    </div>

                    <div class="form-group row">
                        <label for="short_descInput" class="col-sm-3 col-form-label">Upload Images</label>
                        <div class="col-sm-6">
                            <input type="file" name="new_images[]" multiple id="photo-upload"
                                class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="py-3 file-upload-browse btn btn-gradient-primary" type="button">Upload
                                        Images</button>
                                    Note: size: 550px by 550px
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="brand_idInput" class="col-sm-3 col-form-label">Brand</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="brand_id" id="brand_idInput">
                                <option value=""> Select Brand</option>
                                @if (count($brands) > 0)
                                    @foreach ($brands as $key => $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('brand_id')
                                <span class="text-danger ">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="prod_catsInput" class="col-sm-3 col-form-label">Categories</label>
                        <div class="col-sm-9 section_scroll">
                            <div class="form-group">
                                @if (count($categories) > 0)
                                    @foreach ($categories as $key => $category)
                                        <?php $dash = ''; ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="prod_cats[]" value="{{ $category->id }}"
                                                    class="form-check-input">{{ $category->title }}</label>
                                        </div>
                                        @if (count($category->subcategory))
                                            @include('admin.components.subcatcheckbox', [
                                                'subcategories' => $category->subcategory,
                                                'product_cat_selected' => '',
                                            ])
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            @error('prod_cats')
                                <span class="text-danger ">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="brand_idInput" class="col-sm-3 col-form-label">Avalable Sizes</label>
                        <div class="col-sm-9 section_scroll">
                            <div class="form-group">
                                @if (count($productsizes) > 0)
                                    @foreach ($productsizes as $key => $productsize)
                                        <?php $dash = ''; ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="prod_sizes[]"
                                                    value="{{ $productsize->id }}"
                                                    class="form-check-input">{{ $productsize->title }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            @error('prod_sizes')
                                <span class="text-danger ">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="brand_idInput" class="col-sm-3 col-form-label">Avalable Colors</label>
                        <div class="col-sm-9 section_scroll">
                            <div class="form-group">
                                @if (count($productcolors) > 0)
                                    @foreach ($productcolors as $key => $productcolor)
                                        <?php $dash = ''; ?>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="prod_colors[]"
                                                    value="{{ $productcolor->id }}"
                                                    class="form-check-input">{{ $productcolor->title }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            @error('prod_sizes')
                                <span class="text-danger ">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="availablestockInput" class="col-sm-3 col-form-label">Available Stock</label>
                        <div class="col-sm-9">
                            <input type="number" name="availablestock" class="form-control" value=""
                                id="titleInput" placeholder="Enter available stock">
                            @error('availablestock')
                                <span class="text-danger ">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="stock_statusInput" class="col-sm-3 col-form-label">Stock</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="stock_status" id="stock_statusInput">
                                <option value="1">In Stock</option>
                                <option value="0">Out Of Stock</option>
                            </select>
                            @error('stock_status')
                                <span class="text-danger ">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="statusInput" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="status" id="statusInput">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger ">* {{ $message }} </span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info sfw">Create</button>
                    <a href="{{ route('product.index') }}" class="btn btn-info sfw"><i class="fa fa-mail-reply"></i>
                        Cancel </a>
                </div>
            </div>
        </div>
    </form>
@endsection
