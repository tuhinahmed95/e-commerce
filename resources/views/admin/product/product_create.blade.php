@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Product Create</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('prduct.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        <option value="">Select Category</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Sub Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">Select Subcategory</option>
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Brand</label>
                                    <select name="brand_id" class="form-control">
                                        <option value="">Select Brand</option>
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Name</label>
                                    <input type="text" name="product_name" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Product Price</label>
                                    <input type="number" name="price" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Discount</label>
                                    <input type="number" name="discount" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Short Description</label>
                                    <input type="text" name="short_des" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Tags</label>
                                    <input type="text" name="tags[]" id="input-tags" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Long Description</label>
                                    <textarea name="long_des" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Additional Information</label>
                                    <textarea name="addi_info" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Preview Image</label>
                                    <input type="file" name="preview" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Gallery Image</label>
                                    <input type="file" name="gallery" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Add Product</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_script')
    <script>
        $("#input-tags").selectize({
            delimiter: ",",
            persist: false,
            create: function (input) {
                return {
                    value: input,
                    text: input,
                };
            },
        });
    </script>
@endsection
