@extends('layouts.master')

@section('title', 'Navigation bar CMS')

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
    <script src="{{ mix('js/pages/index.js') }}"></script>
@endpush

@section('content')
    <style>
        label.error {
            color: #ff0000;
        }
        input.error {
            border-color: #ff0000;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="alert alert-success hidden">
                        <strong>Save Success!</strong>
                    </div>
                    <div class="alert alert-danger hidden">
                        <strong>Save Failed <span></span></strong>
                    </div>
                </div>
                <div class="row">
                    <h2>
                        Navigation Bar - CMS
                        {{--@Todo check how do we set this--}}
                        {{--@can('navigation-bar-edit')--}}
                        <button id="save-nav" class="btn btn-success pull-right" data-content="">
                            <i class="fa fa-save"></i> Save
                        </button>
                        <button id="add-new-cat" class="btn btn-primary pull-right"> + Add new Category</button>
                        {{--@endcan--}}
                    </h2>
                </div>
                <form id="navigation-cms">
                </form>
                <div style="display: none;" id="block-data" class="col-sm-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Navigation items
                            <button class="btn btn-sm btn-danger btn-delete pull-right">Delete</button>
                        </div>
                        <div class="panel-body">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Category name
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-sm-6">
                                            <div>English</div>
                                            <input id="cmsbar-categoryname-en" type="text" class="form form-control cmsbar-category-en"
                                                    name="cmsbar[0][category_name][en]"
                                                    value="" required
                                            >
                                        </div>
                                        <div class="col-sm-6">
                                            <div>Thai</div>
                                            <input id="cmsbar-categoryname-th" type="text" class="form form-control cmsbar-category-th"
                                                    name="cmsbar[0][category_name][th]"
                                                    value="" required
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Title
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-sm-6">
                                            <div>English</div>
                                            <input id="cmsbar-title-en" type="text" class="form form-control cmsbar-title-en"
                                                    name="cmstitleen"
                                                    value=""
                                            >
                                        </div>
                                        <div class="col-sm-6">
                                            <div>Thai</div>
                                            <input id="cmsbar-title-th" type="text" class="form form-control cmsbar-title-th"
                                                    name="cmstitleth"
                                                    value=""
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Color
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-sm-12">
                                            <input id="cmsbar-color" type="text" class="form form-control"
                                                    name="cmscolor" required
                                                    value="" placeholder="Color code eg : #ffffff"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Related Article ID
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-sm-6">
                                            <input id="cmsbar-realated-id-en" type="number" class="form form-control"
                                                    name="cmsrelatediden"
                                                    value="" placeholder="Number ex: 1"
                                            >
                                        </div>
                                        <div class="col-sm-6">
                                            <input id="cmsbar-realated-id-th" type="number" class="form form-control"
                                                    name="cmsrelatedidth"
                                                    value="" placeholder="Number ex: 1"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Advertisement ID
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-sm-12">
                                            <input id="cmsbar-ads-id" type="text" class="form form-control"
                                                    name="csmadsid"
                                                    value="" placeholder="eg: div-gpd-01515ad-d"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Order of Navigation
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-sm-12">
                                            <input id="cmsbar-order" type="number" class="form form-control"
                                                    name="cmsorder" required
                                                    value="" placeholder="eg: number"
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Link
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-sm-6">
                                            <div>English</div>
                                            <input id="cmsbar-link-en" type="text" class="form form-control"
                                                    name="cmslinken" required
                                                    value=""
                                            >
                                        </div>
                                        <div class="col-sm-6">
                                            <div>Thai</div>
                                            <input id="cmsbar-link-th" type="text" class="form form-control"
                                                    name="cmslinkth" required
                                                    value=""
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Sub-menu
                                        <button class="btn btn-sm btn-success pull-right btn-add"
                                                id="btn-add" name="btn-add[0]"
                                        >
                                            + Add
                                        </button>
                                    </div>
                                    <div id="sub-catagory-container" class="panel-body"></div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Promotions
                                        <button class="btn btn-sm btn-success pull-right btn-add-promotions"
                                                id="btn-add-promotions" name="btn-add-promotions[0]"
                                        >
                                            + Add
                                        </button>
                                    </div>
                                    <div id="promotions-container" class="panel-body"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: none;" id="sub-category" class="panel panel-info">
                    <div class="panel-body">
                        <button class="btn btn-sm btn-danger btn-delete-sub">Delete</button>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Title
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-6">
                                    <div>English</div>
                                    <input type="text" class="form form-control pages-title-en"
                                            id="sub-cat-title-en"
                                            name="cmsbar[0][pages][0][title][en]"
                                            value="" required
                                    >
                                </div>
                                <div class="col-sm-6">
                                    <div>Thai</div>
                                    <input type="text" class="form form-control pages-title-th"
                                            id="sub-cat-title-th"
                                            name="cmsbar[0][pages][0][title][th]"
                                            value="" required
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Link address
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-6">
                                    <div>English</div>
                                    <input type="text" class="form form-control pages-link-en"
                                            id="sub-cat-link-en"
                                            name="cmsbar[0][pages][0][link][en]"
                                            value="" required
                                    >
                                </div>
                                <div class="col-sm-6">
                                    <div>Thai</div>
                                    <input type="text" class="form form-control pages-link-th"
                                            id="sub-cat-link-th"
                                            name="cmsbar[0][pages][0][link][th]"
                                            value="" required
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Icon name (Image name)
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <input id="sub-cat-icons" type="text" class="form form-control"
                                            name="cmscolor" required
                                            value="" placeholder="car-insurance"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Order Sub-menu
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <input id="sub-cat-orders" type="number" class="form form-control"
                                            name="cmscolor" required
                                            value="" placeholder="car-insurance"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: none;" id="sub-promotion" class="panel panel-info">
                    <div class="panel-body">
                        <button class="btn btn-sm btn-danger btn-delete-sub">Delete</button>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Title
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-6">
                                    <div>English</div>
                                    <input type="text" class="form form-control promotion-title-en"
                                            id="promotion-title-en"
                                            name="cmsbar[0][pages][0][promotions][en]"
                                            value="" required
                                    >
                                </div>
                                <div class="col-sm-6">
                                    <div>Thai</div>
                                    <input type="text" class="form form-control promotion-title-th"
                                            id="promotion-title-th"
                                            name="cmsbar[0][pages][0][promotions][th]"
                                            value="" required
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Link address
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-6">
                                    <div>English</div>
                                    <input type="text" class="form form-control promotion-link-en"
                                            id="promotion-link-en"
                                            name="cmsbar[0][pages][0][promotions][en]"
                                            value="" required
                                    >
                                </div>
                                <div class="col-sm-6">
                                    <div>Thai</div>
                                    <input type="text" class="form form-control promotion-link-th"
                                            id="promotion-link-th"
                                            name="cmsbar[0][pages][0][promotions][th]"
                                            value="" required
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Order Promotion
                            </div>
                            <div class="panel-body">
                                <div class="col-sm-12">
                                    <input id="promotion-orders" type="number" class="form form-control"
                                            name="cmscolor" required
                                            value="" placeholder="car-insurance"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection