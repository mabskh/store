@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.categories') }}"> الاقسام
                                    </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل قسم
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل القسم
                                        | {{ $category->name }}  </h4>
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
                                              action="{{route('admin.categories.update',$category -> id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <input name="id" value="{{$category -> id}}" type="hidden">

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                        src="{{ asset('assets/images/categories/' . $category->photo) }}"
                                                        class="rounded-circle  height-150"
                                                        alt="شعار القسم">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label> شعار القسم </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo" >
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>


                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات القسم</h4>

                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox"
                                                                   value="{{$category -> is_active}}"
                                                                   id="switcheryColor4"
                                                                   class="switchery"
                                                                   placeholder=""
                                                                   name="is_active"
                                                                   data-color="success"
                                                                   @if($category->is_active == 1)checked @endif
                                                            >
                                                            <label for="switcheryColor4" class="card-title ml-1">حالة القسم</label>
                                                            @error("is_active")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group mt-1">
                                                            <input type="radio"
                                                                   name="type"
                                                                   value="1"
                                                                   class="switchery"
                                                                   data-color="success"
                                                                  {{-- @if($category->parent_id == null)checked @endif--}}
                                                            />
                                                            <label
                                                                class="card-title ml-1">
                                                                قسم رئيسي
                                                            </label>
                                                        </div>

                                                    </div>


                                                    <div class="col-md-2">
                                                        <div class="form-group mt-1">
                                                            <input type="radio"
                                                                   name="type"
                                                                   value="2"
                                                                   class="switchery"
                                                                   data-color="success"
                                                                  {{-- @if($category->parent_id !== null)checked @endif--}}
                                                            />
                                                            <label
                                                                class="card-title ml-1">
                                                                قسم فرعي
                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="row hidden" id="cats_list">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> القسم الرئيسي </label>

                                                            <select name="parent_id"
                                                                    id="parent_id"
                                                                    class="form-control">
                                                                <optgroup label="الأقسام">
                                                                    @if($categories && $categories->count()>0)
                                                                        @foreach($categories as $cat)
                                                                            <option @if($category->parent_id == $cat->id) selected @endif
                                                                            value="{{$cat->id}}">{{$cat->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error("parent_id")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label
                                                                for="projectinput1"> اسم القسم </label>
                                                            <input type="text"
                                                                   value="{{$category -> name}}"
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
                                                                   value="{{$category -> slug}}"
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



                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
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
@endsection


@section('script')

    <script>
        $('input:radio[name="type"]').change(
            function () {
                if (this.checked && this.value == '2') {  // 1 if main cat - 2 if sub cat
                    $('#cats_list').removeClass('hidden');
                } else {
                    $('#cats_list').addClass('hidden');
                }
            });
    </script>
@stop




