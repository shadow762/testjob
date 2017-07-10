<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 10.07.2017
 * Time: 10:37
 */
?>
{!! Form::model($employee, ['route' => 'employee.save', 'enctype' => "multipart/form-data"]) !!}
    {!! Form::hidden('id') !!}
    <div class="form-item">
        {!! Form::label('surname', 'Фамилия') !!}
        {!! Form::text('surname', null) !!}
        <span class="error">{{$errors->first('surname')}}</span>
    </div>
    <div class="form-item">
        {!! Form::label('name', 'Имя') !!}
        {!! Form::text('name', null) !!}
        <span class="error">{{$errors->first('name')}}</span>
    </div>
    <div class="form-item">
        {!! Form::label('lastname', 'Отчество') !!}
        {!! Form::text('lastname', null) !!}
        <span class="error">{{$errors->first('lastname')}}</span>
    </div>
    <div class="form-item">
        {!! Form::label('bithday', 'Дата рождения') !!}
        {!! Form::date('bithday', null) !!}
        <span class="error">{{$errors->first('bithday')}}</span>
    </div>
    <div class="form-item">
        {!! Form::label('sex', 'Пол') !!}
        {!! Form::select('sex_id', $sexes, null) !!}
        <span class="error">{{$errors->first('sex')}}</span>
    </div>
    <div class="form-item">
        {!! Form::label('image', 'Фото') !!}
        {!! Form::file('image', ['id' => 'image']) !!}
        <span class="error">{{$errors->first('image')}}</span>
    </div>
    <div class="form-item">
        {!! Form::submit('Сохранить') !!}
        {!! link_to_route('default', 'Отмена') !!}
    </div>
{!! Form::close() !!}
