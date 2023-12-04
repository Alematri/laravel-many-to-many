@extends('layouts.admin')

@section('content')

@if($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $error )
          <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-8">
        <form action="{{ $route }}" method="POST">
            @csrf
            @method($method)

            <div class="mb-3">
                <label for="title" class="form-label">Titolo progetto</label>
                <input
                    id="title"
                    class="form-control @error('title') is-invalid @enderror"
                    name="title"
                    type="text"
                    value="{{old('title')}}"
                >
                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">

                <label for="techonology_id" class="form-label">Tecnologia</label>

                <select name="technology_id" class="form-select" id="technology_id">
                    <option value="">Scegli una tecnologia</option>
                    @foreach ( $technologies as $technology )
                        <option
                        value="{{ $technology->id }}"
                        {{ old ('technology_id', $project?->technology_id) == $technology->id?'selected' : ''}}
                        >
                        {{ $technology -> name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

                    @foreach ($types as $type)
                        <input
                        type="checkbox"
                        class="btn-check"
                        id="tag_{{ $type->id }}"
                        autocomplete="off"
                        name="types[]"
                        value="{{ $type->id }}"

                            @if ($errors->any() && in_array($type_id, old('types',[])))
                                checked
                            @elseif (!$errors->any() && $project->types->contains($type))
                                checked
                            @endif

                        >
                        <label class="btn btn-outline-primary" for="btncheck1">{{ $type->name }}</label>
                    @endforeach

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Invia</button>
            <button type="reset" class="btn btn-primary">Annulla</button>

        </form>
    </div>
</div>

@endsection
