@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="todo__content">
    <form class="alert__message">
        @if (session('message'))
        <div class="alert__message-success">
            {{session('message')}}
        </div>
        @endif
        @if($errors->any())
        <div class="alert__message-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>
    <form action="/todos" method="post">
        @csrf
        <div class="create-form">
            <div class="create-form__input">
                <input class="create-form__input-text" type="text" name="content" id="">
            </div>
            <div class="create-form__button">
                <button type="submit" class="create-form__button-submit">作成</button>
            </div>
        </div>
    </form>
    <div class="todo-list">
        <div class="todo-list__header">Todo</div>
        @foreach($todos as $todo)
        <ul class="todo-list__content">
            <li class="todo-list__content-item">
                <form action="/todos/update" method="post" class="update-form">
                    @csrf
                    @method('patch')
                    <div class="content-list__item-input">
                        <input class="content-list__input-text" type="text" name="content" value="{{$todo['content']}}">
                        <input type="hidden" name="id" value="{{ $todo['id'] }}">
                    </div>
                    <div class="content-list__item-button-update">
                        <button type="submit" class="content-list__item-button-update-submit">更新</button>
                    </div>
                </form>
                <form action="/todos/delete" method="post" class="delete-form">
                    @csrf
                    @method('delete')
                    <div class="content-list__item-button-delete">
                        <input type="hidden" name="id" value="{{$todo['id']}}">
                        <button type="submit"class="content-list__item-button-delete-submit">削除</button>
                    </div>
                </form>
            </li>
        </ul>
        </form>
        @endforeach
    </div>
</div>
@endsection