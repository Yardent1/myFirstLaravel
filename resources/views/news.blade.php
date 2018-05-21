<!-- resources/views/news.blade.php -->

@extends('layouts.app')

@section('content')

<!-- Bootstrap шаблон... -->

<div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма новой задачи -->
    <form action="{{ url('news') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Имя задачи -->
        <div class="form-group">
            <label for="news" class="col-sm-3 control-label">НОВОСТИ</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="news-name" class="form-control">
                <input type="text" name="text" id="news-text" class="form-control">
            </div>
        </div>

        <!-- Кнопка добавления задачи -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Добавить новость
                </button>
            </div>
        </div>
    </form>
</div>
@if (count($news) > 0)
    <div class="panel panel-default">
      <div class="panel-heading">
        
      </div>

      <div class="panel-body">
        <table class="table table-striped task-table">

          <!-- Заголовок таблицы -->
          <thead>
            <th>Новости</th>
            <th>Текст</th>
            <th>Дата изменения</th>
            <th></th>
          </thead>

          <!-- Тело таблицы -->
          <tbody>
            @foreach ($news as $news_item)
              <tr>
                <!-- Имя новости -->
                <td class="table-text">
                  <div title="{{$news_item->text}}">{{ $news_item->name }}</div>
                </td>
                <td class="table-text">
                  <div title="{{$news_item->updated_at}}">{{ $news_item->text }}</div>
                </td>
                <td class="table-text">
                  <div>{{ $news_item->updated_at }}</div>
                </td>

                <td>
                    <form action="{{url('news/'.$news_item->id)}}" method="post">
                        {{csrf_field()}}
                       {{method_field('delete')}}
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Удалить </button>
                    </form>
                </td>
                <td>
<!--                    <a href="{{url('news/'.$news_item->id.'/edit')}}"class="fa fa-edit"></a>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-edit"></i></button>
-->
                     <form action="{{url('news/'.$news_item->id.'/edit')}}" method="get">
                        {{csrf_field()}}
                       
                        <button type="submit" class="btn btn-default"> <i class="fa fa-edit"></i> Редактировать</button>
                    </form>  
                  
                    
                    
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
   @endif

@endsection