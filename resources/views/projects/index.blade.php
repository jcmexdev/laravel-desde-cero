@extends('layout')

@section('title', 'Projects')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        @isset($category)
            <div>
                <h1 class="display-4 mb-0">{{ $category->name }}</h1>
                <a href="{{ route('projects.index') }}">Regresar al portafolio</a>
            </div>
        @else
            <h1 class="display-4 mb-0">@lang('Projects')</h1>
        @endisset

        @auth
            @can('create-projects')
                    <a class="btn btn-primary" href="{{ route('projects.create') }}">Crear proyecto</a>
            @endcan
        @endauth
    </div>
    <p class="lead text-secondary">Proyectos realizados Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
    <div class="d-flex flex-wrap justify-content-between align-items-start">
        @forelse($projects as $project)
        <div class="card mb-4 shadow-sm" style="width: 18rem;">
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
                    @if ($project->category_id)
                        <a href="{{ route('categories.show', $project->category) }}" class="badge badge-secondary">{{ $project->category->name }}</a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <li class="list-group-item border-0 mb-3 shadow-sm">
            No hay proyectos para mostrar
        </li>
        @endforelse
    </div>
    {{ $projects->links() }}
</div>
@endsection
