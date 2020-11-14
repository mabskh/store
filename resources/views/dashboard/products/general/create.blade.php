@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{route('admin.dashboard')}}">{{__('admin/shipping.main')}} </a>
                                </li>

                                <li class="breadcrumb-item active"><a
                                        href="{{route('admin.categories')}}">{{__('admin/products.products')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin/categories.add')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"
                                        id="basic-layout-form"> اضافة منتج </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('admin.products.general.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                <h4 class="form-section"><i
                                                        class="ft-home"></i> بيانات المنتج
                                                </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> اسم المنتج </label>
                                                            <input type="text"
                                                                   value="{{old('name')}}"
                                                                   id="name"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> الاسم بالرابط </label>
                                                            <input type="text"
                                                                   value="{{old('slug')}}"
                                                                   id="slug"
                                                                   class="form-control"
                                                                   placeholder=""
                                                                   name="slug">
                                                            @error("slug")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> وصف المنتج</label>
                                                            <textarea type="text" cols="8" rows="3"
                                                                      value="{{old('description')}}"
                                                                      id="ckeditor"
                                                                      class="ckeditor form-group"
                                                                      name="description"> </textarea>

                                                            @error("description")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> الوصف المختصر </label>
                                                            <textarea type="text"
                                                                      value="{{old('short_description')}}"
                                                                      id="txtEditor"
                                                                      class="form-control"
                                                                      placeholder=""
                                                                      name="short_description"> </textarea>

                                                            @error("short_description")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"
                                                                   value="1"
                                                                   id="switcheryColor4"
                                                                   class="switchery"
                                                                   name="is_active"
                                                                   data-color="success"
                                                                   checked>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة</label>
                                                            @error("is_active")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="row" id="cats_list">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1">  اختر القسم </label>
                                                            <select name="categories[]"
                                                                    id="categories"
                                                                    class="select2 form-control" multiple>
                                                                <optgroup
                                                                    label="اختر قسم من فضلك">
                                                                    @if($data['categories'] && $data['categories']->count()>0)
                                                                        @foreach($data['categories'] as $category)
                                                                            <option
                                                                                value="{{$category->id}}">{{$category->name}}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error("categories")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1">العلامات الدلالية Tags </label>
                                                            <select name="tags[]"
                                                                    id="tags"
                                                                    class="select2 form-control"
                                                                    multiple >
                                                                <optgroup
                                                                    label="العلامات الدلالية Tags">
                                                                    @if($data['tags'] && $data['tags']->count()>0)
                                                                        @foreach($data['tags'] as $tag)
                                                                            <option
                                                                                value="{{$tag->id}}">{{$tag->name}}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error("tags")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> العلامة التجارية البراند </label>

                                                            <select name="brand_id"
                                                                    id="brand_id"
                                                                    class="form-control"
                                                                    >
                                                                <optgroup
                                                                    label="العلامة التجارية البراند">
                                                                    @if($data['brands'] && $data['brands']->count()>0)
                                                                        @foreach($data['brands'] as $brand)
                                                                            <option
                                                                                value="{{$brand->id}}">{{$brand->name}}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error("brand_id")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                                <div class="form-actions">
                                                    <button type="button" class="btn btn-warning mr-1"
                                                            onclick="history.back();">
                                                        <i class="ft-x"></i>تراجع
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i>حفظ
                                                    </button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@stop


@section('script')
    <script src="{{asset('assets/admin/vendors/js/editors/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/js/scripts/editors/editor-ckeditor.js')}}" type="text/javascript"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    @stop
