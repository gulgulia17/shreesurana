<div class="d-flex">
    <a href="{{ route('files.show', $data->id) }}" class="btn btn-sm btn-info mx-1" data-toggle="modal"
        data-target="#leadDetails{{ $data->id }}">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
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
                            <label for="name">Name</label>
                            <input type="text" disabled id="name" class="form-control" placeholder=""
                                value="{{ $data->name }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="number">Number</label>
                            <input type="text" disabled id="number" class="form-control" placeholder=""
                                value="{{ $data->number }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="address">Address</label>
                            <input type="text" disabled id="address" class="form-control" placeholder=""
                                value="{{ $data->name }}">
                        </div>
                        <div class="form-group col-md-12">
                            <select class="form-control" name="response" id="response">
                                <option value="">Choose response</option>
                                <option></option>
                                <option></option>
                            </select>
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
