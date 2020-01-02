<form class="forms-sample" action="{{ route('admin.answers.store') }}" method="POST">
    @csrf()
    <div class="form-group">
        <label>Add votes</label>
        <input class="mt-2 form-control" name="new_votes" type="number" placeholder="How many?">
        <label>For which one?</label>
        <select class="form-control" name="id">
            @foreach($poll->options as $option)
                <option value="{{ $option->id }}">{{ $option->content }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-danger">Add votes</button>
</form>
