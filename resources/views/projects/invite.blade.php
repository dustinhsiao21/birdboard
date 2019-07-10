@can('invite', $project)
<div class="card mt-3">
    <div class="card-header">
        Invite
    </div>
    <div class="card-body">
        <div class="form-group">
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
@endcan