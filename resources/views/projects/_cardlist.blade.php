<div class="col-4 my-3">
    <div class="card project-card h-100">

        <ul class="icon-bar">
            <li>
                @include('projects._deleteForm')
            </li>

            <li>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProjectModal-{{ $project->id }}">
                    <i class="fa fa-btn fa-cog"></i>
                </button>
            </li>
        </ul>

        <a href="{{ route('projects.show', $project->id ) }}">
            <img src="{{ asset('storage/thumbs/original/' . $project->thumbnail) }}" class="card-img-top" alt="{{ $project->name }}">
        </a>
        
        <div class="card-body py-3">
            <a href="{{ route('projects.show', $project->id ) }}">
                <h6 class="card-title text-center">{{ $project->name }}</h5>
            </a>        
        </div>
    </div>

    @include('projects._editModal')

</div>    