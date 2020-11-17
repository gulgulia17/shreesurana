<div class="form-group">
    <label for="name">Name</label>
    <textarea class="form-control @error('name') is-invalid @enderror" name="name" id="name" rows="3"
        placeholder="Please enter the response">{{ old('name') ?? $response->name }}</textarea>
    @error('name')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>
<button class="btn btn-info w-100 btn-sm">Submit</button>
