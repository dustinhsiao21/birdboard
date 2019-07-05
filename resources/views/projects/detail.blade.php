<div class="card mt-3">
    <div class="card-body">
        <p> Owner: {{ $project->user->name }}</p>
        <div class="mt-4">
            Members:
            @foreach ($project->members as $member)
                <p class="text-primary my-1">{{ $member->name }}</p>
            @endforeach
        </div>
    </div>
</div>