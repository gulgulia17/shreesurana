<div class="d-flex">
    <a href="{{ route('company.edit', $model->id) }}" class="btn btn-sm btn-warning mx-1">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a href="{{ route('company.destroy', $model->id) }}" data-id="delete-form-{{ $model->id }}"
        class="btn btn-sm btn-danger mx-1" onclick="deleteData(event,this);">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>
    <form id="delete-form-{{ $model->id }}" action="{{ route('company.destroy', $model->id) }}" method="POST" style="display: none;">
        @csrf @method('delete')
    </form>
</div>

