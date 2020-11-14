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
                                        href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>

                                <li class="breadcrumb-item active"><a
                                        href="{{route('admin.products')}}">المنتجات</a>
                                </li>
                                <li class="breadcrumb-item active">إضافة منتج
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
                                              action="{{route('admin.products.general.update' , $product->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input name="id" type="hidden" value="{{ $product->id }}">
                                            <div class="form-body">
                                                <h4 class="form-section"><i
                                                        class="ft-home"></i> تعديل المنتج
                                                </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> اسم المنتج </label>
                                                            <input type="text"
                                                                   value={{ $product -> name }}
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
                                                                   value={{ $product -> slug }}
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
                                                                      value=
                                                                      id="ckeditor"
                                                                      class="ckeditor form-group"
                                                                      name="description"> {{ $product -> description }}</textarea>

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
                                                                      value=
                                                                      id="txtEditor"
                                                                      class="form-control"
                                                                      placeholder=""
                                                                      name="short_description"> {{ $product -> short_description }}</textarea>

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
                                                                   @if ($product -> is_active == 1) checked @endif>
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
                                                                    label="الاقسام">
                                                                    @if($data['categories'] && $data['categories']->count()>0)
                                                                        @foreach($data['categories'] as $category)
                                                                            <option
                                                                               {{-- @if($product->id == $category->id) selected @endif--}}
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
                                                                    class="select2 form-control" multiple>
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
                                                                    class="form-control">
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
