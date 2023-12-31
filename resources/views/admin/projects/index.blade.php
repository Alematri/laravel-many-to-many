@extends('layouts.admin')


@section('content')

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        <a href="{{ route('admin.order-by',['direction'=>$direction, 'column'=>'id']) }}">ID</a>
                    </th>
                    <th scope="col">Titolo</th>
                    <th scope="col">Tecnologia</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
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
