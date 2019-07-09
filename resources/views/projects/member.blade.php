<div class="card mt-3">
    <div class="card-header">
        Member
    </div>
    <div class="card-body">
        <p> Owner: {{ $project->user->name }}</p>
        <div class="mt-4">
            Members:
            @if($project->members->count() > 0)
                @foreach ($project->members as $member)
                    <p class="text-primary my-1">{{ $member->name }}</p>
                @endforeach
            @else
                No Members
            @endif
        </div>
    </div>
</div>