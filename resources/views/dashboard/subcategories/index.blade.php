@extends('layouts.admin')

@section('title')
        Sub Categories
    @stop

@section('content')
    <div class="app-content content">
        <div class="content-wrapper mt-0">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 ">
                    <h3 class="content-header-title" style="font-family: 'Cairo', Georgia, 'Times New Roman', Times, serif"> الأقسام الفرعية </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسيه</a>
                                </li>
                                <li class="breadcrumb-item active"> الأقسام الفرعية
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع الأقسام الفرعية </h4>
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
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-Horizontal ">
                                            <thead>
                                            <tr>
                                                <th> اسم القسم الفرعي</th>
                                                <th>  الاسم بالرابط</th>
                                                <th>الحالة</th>
                                                <th> صورة القسم</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($categories)
                                                @foreach($categories as $category)
                                                    <tr>
                                                        <td>     {{ $category -> name  }}         </td>
                                                        <td>    {{ $category -> slug  }}       </td>
                                                        <td>    {{ $category -> getActive()  }}       </td>
                                                        <td>    <img style="width: 100px ; height: 100px" src="">   </td>

                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{ route('admin.subcategories.edit', $category-> id )}}"
                                                                   class="btn btn-outline-primary btn-sm btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                                <a href="{{ route('admin.subcategories.delete', $category->id) }}"
                                                                   class="btn btn-outline-danger btn-sm btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                                <a href="{{ route('admin.subcategories.changeStatus', $category->id) }}"
                                                                   class="btn btn-outline-warning btn-sm btn-min-width box-shadow-3 mr-1 mb-1">

                                                                    @if($category -> is_active == 0)
                                                                        تفعيل
                                                                    @else
                                                                        الغاء تفعيل
                                                                    @endif</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @stop
