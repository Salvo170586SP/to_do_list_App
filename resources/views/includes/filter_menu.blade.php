<div class="offset-3 col-6 mt-4">
    <hr>
    <a class="btn btn-sm btn-outline-primary {{ (Request::url() === 'http://127.0.0.1:8000/posts') ? 'active' : ''  }}" href="{{ route('posts.index') }}">All</a>

    <a class="btn btn-sm btn-outline-primary {{ (Request::url() === 'http://127.0.0.1:8000/getCompleted') ? 'active' : ''  }}"
        href="{{ route('posts.getCompleted') }}">Completed</a>

    <a class="btn btn-sm btn-outline-primary {{ (Request::url() === 'http://127.0.0.1:8000/getIncompleted') ? 'active' : ''  }}"
        href="{{ route('posts.getIncompleted') }}">Incompleted</a>
    <hr>
</div>
