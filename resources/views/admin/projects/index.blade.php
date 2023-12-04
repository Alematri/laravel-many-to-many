@extends('layouts.admin')


@section('content')

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Titolo</th>
                    <th scope="col">Tech</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td >{{ $project->title }}</td>
                        <td>{{ $project->technology->name ?? '-'}}</td>
                        <td>
                            @forelse ( $project->types as $type )
                            <span class="badge text-bg-info">{{ $type->name }}</span>
                            @empty
                                -
                            @endforelse
                        </td>
                        <td><a href="{{route('admin.projects.show', $project)}}"><i class="fa-solid fa-eye"></i></a></td>
                        <td><a href="{{route('admin.projects.edit', $project)}}"><i class="fa-solid fa-pencil"></i></a></td>

                    </tr>
                @endforeach
            </tbody>

        </table>

    {{ $projects->links() }}
@endsection
