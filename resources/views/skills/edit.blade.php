@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <a href="{{ url('/admin/skills') }}">
                {{ __('names.skills') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('names.editSkill') }}
            </span>
        </div>
    </div>
    <div class="container">
        @include('messages')
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center mt-3 mb-4">
                    <h3 class="mb-4 mb-md-0" style="font-family: 'Times New Roman', sans-serif">
                        {{ __('names.editSkill') }}
                    </h3>
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <a href="{{ url('/admin/skills') }}"
                           class='btn btn-primary orders-returns-primary-button'>
                            <i class="fa-solid fa-arrow-left fs-6 me-2"></i>
                            {{ __('buttons.back') }}
                        </a>
                    </div>
                </div>
                <div class="row bg-white mx-md-0 p-3 ps-4 py-4">
                    {!! Form::model($skill, ['route' => ['skills.update', $skill->id], 'method' => 'patch', 'class' => 'row px-0']) !!}
                        <div class="form-group col-12 mb-2">
                            {!! Form::label('name', __('table.name')) !!}
                            {!! Form::text('name', $skill->name, ['class' => 'form-control', 'step' => '0.01', 'style' => 'border-radius: 0']) !!}
                        </div>
                        <div class="d-flex align-items-center justify-content-center mt-4 col-12">
                            <button type="submit" class='btn btn-primary orders-returns-primary-button col-lg-4 col-md-6 col-12'>
                                {{ __('buttons.save') }}
                            </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
