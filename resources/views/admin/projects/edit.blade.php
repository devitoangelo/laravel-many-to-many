@extends('layouts.admin')

@section('content')
    <header class="py-3 bg-dark text-white">
        <div class="container d-flex align-items-center justify-content-between">
            <h1>Editing post : {{ $project->title }}</h1>
        </div>
    </header>

    <div class="container" style="margin-top: 1rem">


        @include('partials.validation-messages')


        <form action="{{ route('admin.project.update', $project) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    id="title" aria-describedby="titlehelpId" placeholder="title"
                    value="{{ old('title', $project->title) }}" />
                <small id="titlehelpId" class="form-text text-muted">Type a title for project </small>
                @error('title')
                    <div class="text-danger py-2">
                        {{ $message }}

                    </div>
                @enderror
            </div>

            <div class="mb-3">


                @if (Str::startsWith($project->cover_image, 'https:://'))
                    <img width="140" src="{{ $project->cover_image }}" alt="{{ $project->title }}">
                @else
                    <img width="140" src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}">
                @endif

                <label for="cover_image" class="form-label">cover_image</label>
                <input type="file" class="form-control" @error('cover_image') is-invalid @enderror name="cover_image"
                    id="cover_image" aria-describedby="cover_imagehelpId" placeholder="cover_image"
                    value="{{ old('cover_image', $project->cover_image) }}" />
                <small id="cover_imagehelpId" class="form-text text-muted">Type a cover_image for project </small>
                @error('cover_image')
                    <div class="text-danger py-2">
                        {{ $message }}

                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is_invalid @enderror" name="content" id="content" rows="5">{{ old('content', $project->content) }}</textarea>
                @error('title')
                    <div class="text-danger py-2">
                        {{ $message }}

                    </div>
                @enderror



                <div class="mb-3">
                    <label for="type_id" class="form-label">Type</label>
                    <select class="form-select form-select-lg" name="type_id" id="type_id">
                        <option selected disabled>Select a Type</option>
                        {{-- foreach per il tipo di progetto --}}
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}"{{$project->type_id == old('type_id', $type->id) ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach

                    </select>
                </div>





            </div>

            <button type="submit" class="btn btn-primary">
                Save
            </button>




        </form>
    </div>
@endsection
