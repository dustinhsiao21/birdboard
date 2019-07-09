<h3 class="border-left border-4 border-primary ml-n3 p-2">
    <a class="text-dark text-decoration-none" href="{{ route('project.show', ['id' => $project->id])}}">{{ $project->title }}</a>
</h3>
<p class="text-secondary">{{ Str::limit($project->description, 100) }}</p>
@can('delete', $project)
<div class="row justify-content-end mr-3">
    <button type="button" class="btn btn-danger" @click="$modal.show('project-delete-modal')">Delete</button>
</div>
@endcan
<project-delete-modal :project-id="{{ $project->id }}"></project-delete-modal>

