@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    {!! $post->safe_html_content !!}
    <p>{{ $post->user->name }}</p>

    {!! Form::open(['route'=> ['comments.store', $post], 'method'=>'POST']) !!}

        {!! Field::textarea('comment') !!}

        <button type="submit">Publicar comentario</button>

    {!! Form::close() !!}

    @foreach ($post->latestComments as $comment)
        <article class="{{ $comment->answer ? 'answer' : '' }}">

            {{-- todo: support markdown in the comments as well! --}}
            
            {{ $comment->comment }}

            @if (Gate::allows('accept', $comment) && !$comment->answer)
                {!! Form::open(['route' => ['comments.accept', $comment], 'method' => 'POST']) !!}
                <button type="submit">Aceptar respuesta</button>
                {!! Form::close() !!}
            @endif
        </article>
    @endforeach
@endsection