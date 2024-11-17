@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" class="form-control" value="{{ $task->title }}" name="title">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea class="form-control" rows="5" name="contents">{{ $task->contents }}</textarea>
                </div>
                <div class="form-group">
                    <label for="finish_date">デッドライン:</label>
                    <input type="date" id="finish_date" name="finish_date" class="form-control" value="{{ old('finish_date', $task->finish_date) }}">
                </div>
                <div class="form-group">
                    <label for="image_at">Choose a photo!</label>
                    <input type="file" id="image_at" name="image_at" class="form-control">
                </div>                
                  <div class="form-group">
                   <label for="color">色選んで:</label>
                   <select name="color_id" id="color" required>
                    @foreach($colors as $color)
                     <option value="{{ $color->id }}"{{ $task->color_id == $color->id ? 'selected' : '' }}>{{ $color->color_name }}</option>
                    @endforeach
                   </select>
               </div>
                <button type="submit" class="btn btn-primary">更新する</button>
            </form>
        </div>
    </div>
  </div>
@endsection