<!-- resources/views/tasks.blade.php -->

@extends('layouts.app')

@section('content')

<!-- Bootstrap шаблон... -->

<div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
@if(!empty($news_item))
    <!-- Форма новой задачи -->
    <form action="{{ url('news/edit') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$news_item->id}}"/>
        <!-- Имя задачи -->
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Редактировать</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="news-name" class="form-control" value="{{$news_item->name}}">
                <input type="text" name="text" id="news-text" class="form-control" value="{{$news_item->text}}">
                
            </div>
        </div>

        <!-- Кнопка добавления задачи -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-save"></i> Сохранить
                </button>
            </div>
        </div>
    </form>
    @else
    <p> Нет новости для редактирования <a href="{{url('/news')}}">Все новости</a></p>
    @endif
</div>
@endsection