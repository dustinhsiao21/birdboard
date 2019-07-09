<div class="card mt-3">
    <div class="card-header">
        Updated Log
    </div>
    <div class="card-body">
        @foreach ($project->activities as $activity)
            <div class="row">
                <div class="col-9 text-truncate">
                    @include("projects.activity.{$activity->description}")
                </div>
                <div class="col-3 text-truncate">
                    <p class="text-secondary">{{ $activity->created_at->diffForHumans(null, true)}}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>