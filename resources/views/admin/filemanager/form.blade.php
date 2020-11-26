<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required
        value="{{ old('name') ?? $file->name }}">
    @error('name')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
        rows="3">{{ old('description') ?? $file->description }}</textarea>
    @error('description')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>

<div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <label for="file">Choose Excle only</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('file') is-invalid @enderror" name="file" id="file">
                <label class="custom-file-label" for="file">{{ old('file') ?? $file->file ?? 'Please Choose' }}</label>
            </div>
            @error('file')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label for="companies_id">BelongsTo Company</label>
            <select class="form-control @error('companies_id') is-invalid @enderror" name="companies_id"
                id="companies_id" required>
                <option value="">Please choose a company</option>
                @foreach ($companies as $company)
                    <option {{ (old('companies_id') ?? $file->companies_id) == $company->id ? 'selected' : null }}
                        value="{{ $company->id }}">
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            @error('companies_id')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="extracted">Upload and extract</label><br>
            <input type="checkbox" name="extracted" id="extracted" checked data-bootstrap-switch data-on-color="success"
                value="{{ old('extracted') ?? 1 }}">
        </div>
    </div>
</div>
<button class="btn btn-primary btn-sm w-100">Submit</button>
@section('script')
    <script src="{{ asset('assets/js/bootstrap-switch.js') }}"></script>
    <script>
        $(function() {
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
        });

    </script>
@endsection
