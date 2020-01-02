<form class="forms-sample" action="{{ route('admin.options.store', $poll->id) }}" method="POST">
    @csrf()
    <div class="form-group">
        <label>Add new option</label>
        <input class="mt-2 form-control" name="content" type="text" placeholder="Add option">
    </div>
    <button class="btn btn-danger">Add option</button>
</form>
