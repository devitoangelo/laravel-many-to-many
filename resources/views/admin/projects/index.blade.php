@extends('layouts.admin')


@section('content')
    <header class="py-3 bg-dark text-white">
        <div class="container d-flex align-items-center justify-content-between">
            <h1>Projects</h1>
            <a class="btn btn-primary" href="{{ route('admin.project.create') }}">New Post</a>
        </div>
    </header>

    <section class="py-5">
        <div class="container"> 
            <h4 class="text-muted">All Project</h4>
            @include('partials.session-messages')


            <div class="table-responsive">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col"> ID </th>
                            <th scope="col"> Cover Image </th>
                            <th scope="col"> Title </th>
                            <th scope="col"> Slug </th>
                            <th scope="col"> Actions </th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                            <tr class="">
                                <td scope="row">{{ $project->id }}</td>

                                <td>



                                    @if (Str::startsWith($project->cover_image, 'https:://'))
                                        <img width="140" src="{{$project->cover_image }}" alt="{{ $project->title }}">
                                    @else
                                        <img width="140" src="{{ asset('storage/' . $project->cover_image) }}"
                                            alt="{{ $project->title }}">
                                    @endif

                                </td>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->slug }}</td>
                                <td>
                                    <a class="btn btn-dark" href="{{ route('admin.project.show', $project) }}">
                                        <i class="fa-regular fa-eye fa-xs fa-fw"></i>
                                        <span style="font-size: 0.8rem" class="text-uppercase"> View</span>
                                    </a>
                                    <a class="btn btn-dark" href="{{ route('admin.project.edit', $project) }}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        <span style="font-size: 0.8rem" class="text-uppercase"> Edit</span>
                                    </a>



                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal-{{ $project->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modal-{{ $project->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitle-{{ $project->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitle-{{ $project->id }}">
                                                        <i class="fa fa-trash fa-xs fa-fw"></i>
                                                        <span style="font-size: 0.8rem" class="text-uppercase"> Delete
                                                            project</span>
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Destroy this project : {{ $project->title }}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>

                                                    <form action="{{ route('admin.project.destroy', $project) }}"
                                                        method="post">
                                                        @csrf

                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            Confirm
                                                        </button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @empty

                            <tr class="">
                                <td scope="row" colspan="5">No Posts</td>

                            </tr>
                        @endforelse



                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
