<div class="form-group">
    <label for="name">Name</label>
    <textarea class="form-control @error('name') is-invalid @enderror" name="name" id="name" rows="1"
        placeholder="Please enter the response">{{ old('name') ?? $response->name }}</textarea>
    @error('name')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="color">Color</label>
    <input type="color" name="color" id="color" class="form-control @error('color') is-invalid @enderror"
        placeholder="Choose color for your response" value="{{ old('color') ?? $response->color }}">
    @error('name')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>
<button class="btn btn-info w-100 btn-sm">Submit</button>
