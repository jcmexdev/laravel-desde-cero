@extends('layout')

@section('title', 'Projects')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="display-4 mb-0">@lang('Projects')</h1>
        @auth
        <a class="btn btn-primary" href="{{ route('projects.create') }}">Crear proyecto</a>
        @endauth
    </div>
    <p class="lead text-secondary">Proyectos realizados Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
    <div class="d-flex flex-wrap justify-content-between align-items-start">
        @forelse($projects as $project)
        <div class="card mb-2" style="width: 18rem;">
            @if($project->image)
            <img class="card-img-top" src="{{ asset('storage/'.$project->image) }}" alt="{{ $project->title }}"
                style="height:150px; object-fit:cover;">
            @endif

            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                </h5>
                <p class="card-text text-truncate">{{ $project->description }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('projects.show', $project) }}">Ver más...</a>
                    <a href="#" class="badge badge-secondary">{{ optional($project->category)->name }}</a>
                </div>
            </div>
        </div>
        @empty
        <li class="list-group-item border-0 mb-3 shadow-sm">
            No hay proyectos para mostrar
        </li>
        @endforelse
        {{ $projects->links() }}
    </div>
</div>
@endsection
