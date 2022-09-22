@extends('home')

@section('contain')
    <div class="row">
        <div class="col-12">
            <a class="btn btn-primary my-5" href="{{ route('posts.index') }}">Torna alla To Do</a>
            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Descrivi</label>
                    <input type="text" name="description" value="{{ old('description', $post->description)  }}" class="form-control" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label class="form-label">Immagine</label>
                    <input type="url" value="{{ old('image', $post->image )  }}" name="image" class="form-control">
                </div>


                <button type="submit" class="btn btn-primary">Crea</button>
            </form>
        </div>
    </div>
@endsection