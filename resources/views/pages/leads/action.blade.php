<div class="d-flex">
    <a href="{{ route('files.show', $data->id) }}" class="btn btn-sm btn-info mx-1" data-toggle="modal"
        data-target="#leadDetails{{ $data->id }}">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>

    <button data-href="{{ route('lead.update', $data->id) }}" class="btn btn-sm btn-success mx-1"
        onclick="leadClosed(this,event);">
        <i class="fa fa-check" aria-hidden="true"></i>
    </button>
</div>
<div class="modal fade" id="leadDetails{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('lead.action', $data->id) }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Lead Action</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row text-left">
                        <div class="form-group col-md-6">
                            <label for="name{{ $data->id }}">Name</label>
                            <input type="text" disabled id="name{{ $data->id }}" class="form-control" placeholder=""
                                value="{{ $data->name }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="number{{ $data->id }}">Number</label>
                            <input type="text" disabled id="number{{ $data->id }}" class="form-control" placeholder=""
                                value="{{ $data->number }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="response_id{{ $data->id }}">Response</label>
                            <select class="form-control" name="response_id" id="response_id{{ $data->id }}" required
                                onchange="responseChange(this,event)">
                                <option value="">Choose response</option>
                                @foreach ($responses as $response)
                                    <option value="{{ $response->id }}" data-id="{{ $response->jsid }}">
                                        {{ $response->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="later{{ $data->id }}">Later</label>
                            <input type="datetime-local" id="later{{ $data->id }}" name="later" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="remark{{ $data->id }}">Remark</label>
                            <textarea class="form-control" name="remark" id="remark{{ $data->id }}" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-wrench" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
