<div class="bg-white shadow-sm rounded px-3 py-3 h-100">
    <h3 class="border-left border-4 border-primary ml-n3 p-2">
        <a class="text-dark text-decoration-none" href="{{ route('project.show', ['id' => $project->id])}}">{{ $project->title }}</a>
    </h3>
    <p class="text-secondary">{{ Str::limit($project->description, 100) }}</p>
</div>