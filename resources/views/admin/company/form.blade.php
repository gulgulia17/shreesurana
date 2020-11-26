<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
        placeholder="Company Name" value="{{ old('name') ?? $company->name }}" required>
    @error('name')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="number">Number</label>
    <input type="tel" name="number" id="number" class="form-control @error('number') is-invalid @enderror"
        placeholder="Company number if available" value="{{ old('number') ?? $company->number }}">
    @error('number')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="address">Address</label>
    <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="3"
        placeholder="Company address if available">{{ old('address') ?? $company->address }}</textarea>
    @error('address')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>
<button class="btn btn-primary w-100">Submit</button>
