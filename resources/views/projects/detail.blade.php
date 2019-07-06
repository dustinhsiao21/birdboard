<div class="card mt-3">
    <div class="card-body">
        <p> Owner: {{ $project->user->name }}</p>
        <div class="mt-4">
            Members:
            @foreach ($project->members as $member)
                <p class="text-primary my-1">{{ $member->name }}</p>
            @endforeach
        </div>
        <div class="form-group mt-4">
            <form action="{{ route('project.invite', ['project' => $project->id])}}" method="POST">
            @csrf
            <select class="form-control" id="id" name="id">
                @foreach ($users as $user)
                    <option class="form-control" value=" {{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-outline-secondary mt-3" type="submit ">Invite</button>
        </div>
    </div>
</div>