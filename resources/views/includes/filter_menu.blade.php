<div class="col-12 offset-md-3 col-md-6 mt-4">
    <hr>
    <a class="btn btn-sm btn-outline-secondary {{ (Request::url() === 'http://127.0.0.1:8000/posts') ? 'active' : ''  }}" href="{{ url('/') }}">All</a>

    <a class="btn btn-sm btn-outline-secondary {{ (Request::url() === 'http://127.0.0.1:8000/getCompleted') ? 'active' : ''  }}"
        href="{{ route('getCompleted') }}">Completed</a>

    <a class="btn btn-sm btn-outline-secondary {{ (Request::url() === 'http://127.0.0.1:8000/getIncompleted') ? 'active' : ''  }}"
        href="{{ route('getIncompleted') }}">Incompleted</a>
    <hr>
</div>
