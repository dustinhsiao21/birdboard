<div class="card {{ $isSameRow ? 'h-100' : ''}}">
    <h3 class="border-left border-4 border-primary mt-4 p-2">
        <a class="text-dark text-decoration-none" href="{{ route('project.show', ['id' => $project->id])}}">{{ $project->title }}</a>
    </h3>
    <div class="card-body">
        <p class="text-secondary">{{ Str::limit($project->description, 100) }}</p>    
    </div>
    @can('delete', $project)
    <div class="text-right mr-4 mb-4">
        <button type="button" class="btn btn-danger" @click="$modal.show('project-delete-modal')">Delete</button>
    </div>
    @endcan
    <project-delete-modal :project-id="{{ $project->id }}"></project-delete-modal>
</div>
