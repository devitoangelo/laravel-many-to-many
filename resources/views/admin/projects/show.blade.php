@extends('layouts.admin')


@section('content')
    <header class="py-3 bg-dark text-white">
        <div class="container">
            <h1>{{ $project->title }}</h1>

    
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col">             
                    @if (Str::startsWith($project->cover_image, 'https:://'))
                    <img width="500" src="{{$project->cover_image }}" alt="{{ $project->title }}">
                @else
                    <img width="500" src="{{ asset('storage/' . $project->cover_image) }}"
                        alt="{{ $project->title }}">
                @endif
                </div>
                <div class="col">
                    <p> <strong>Title</strong> : {{ $project->title }}</p>
                    <div class="metadata">
                        <strong>Type</strong> : {{$project->type ? $project->type->name : 'Type not' }}

                    </div>
                    <p><strong>Description</strong> : {{ $project->content }}</p>
                </div>
            </div>

        </div>
    </section>
@endsection
