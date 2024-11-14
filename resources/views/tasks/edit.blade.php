@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" class="form-control" value="{{ $task->title }}" name="title">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea class="form-control" rows="5" name="body">{{ $task->body }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">更新する</button>
            </form>
        </div>
    </div>
  </div>
@endsection