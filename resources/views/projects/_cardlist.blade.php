<div class="col-3 my-3">
    <a href="/projects/{{ $project->id }}" class="card">
        <img src="{{ asset('storage/thumbs/original/' . $project->thumbnail) }}" class="card-img-top" alt="{{ $project->name }}">
        <div class="card-body">
            <h6 class="card-title text-center">{{ $project->name }}</h5>
        </div>
    </a>
</div>    