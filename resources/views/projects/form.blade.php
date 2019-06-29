<div class="card w-50 mx-auto">
    @csrf
    <div class="p-5">
        <h3 class="heading text-center">{{ $header }} </h3>
        <div class="pt-5">
            <div class="form-group">
                <label class="label" for="title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $project->title }}">
            </div>
    
            <div class="form-group">
                <label class="label" for="description">Description</label>
                <textarea name="description" class="form-control" placeholder="Type Something...">{{ $project->description}}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
                <a href="{{ $cancelPath ?: $project->path() }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </div>
</div>