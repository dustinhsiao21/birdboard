<div class="card mt-3">
    <div class="card-header">
        Updated Log
    </div>
    <div class="card-body">
        @foreach ($project->activities as $activity)
            <div class="d-flex justify-content-between">
            @include("projects.activity.{$activity->description}")
            <p class="text-secondary">{{ $activity->created_at->diffForHumans(null, true)}}</p>
            </div>
        @endforeach
    </div>
</div>