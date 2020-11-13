<div class="d-flex">
    <a href="{{ route('data.show', $file->id) }}" class="btn btn-sm btn-info mx-1">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
    <a href="{{ route('files.attach', $file->id) }}" class="btn btn-sm btn-success file-attach mx-1">
        <i class="fas fa-link"></i>
    </a>

    @if (!$file->extracted)
        <a href="{{ route('files.import', $file->id) }}" class="btn btn-sm btn-secondary mx-1">
            <i class="fas fa-file-archive" aria-hidden="true"></i>
        </a>
    @endif

    <a href="{{ route('files.edit', $file->id) }}" class="btn btn-sm btn-warning mx-1">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a href="{{ route('files.destroy', $file->id) }}" class="btn btn-sm btn-danger mx-1">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>
</div>
