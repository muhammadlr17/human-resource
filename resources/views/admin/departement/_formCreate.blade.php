<div class="form-group">
    <label for="name" class="control-label sr-only">Departement Name</label>
    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}"
        placeholder="Departement Name" required>
    @foreach ($errors->get('name') as $message)
        <small class="text-danger">{{ $message }}</small>
    @endforeach
</div>

<div class="form-group" hidden>
    <label for="slug" class="control-label sr-only">Slug</label>
    <input type="text" name="slug" class="form-control" id="slug" value="{{ old('slug') }}" placeholder="Slug">
    @foreach ($errors->get('slug') as $message)
        <small class="text-danger">{{ $message }}</small>
    @endforeach
</div>

<div class="form-group">
    <label for="description" class="control-label">Description</label><br>
    <textarea name="description" id="description" class="form-control">
    </textarea>
    @foreach ($errors->get('description') as $message)
        <small class="text-danger">{{ $message }}</small>
    @endforeach
</div>

<a href="{{ route('departements.index') }}" class="btn btn-secondary">Back</a>
<button type="submit" class="btn btn-primary">Submit</button>
