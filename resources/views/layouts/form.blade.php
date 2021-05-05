<form>
    @csrf
    <div class="form-group">
        <label for="inputEmail4">ID Number</label>
        <input type="number" class="form-control" id="inputEmail4">
    </div>
    <div class="form-row">
        <input type="hidden" name="dateInsert" value="{{ date("m/d/y") }}">
        <div class="form-group col-md-6">
            <label>First name</label>
            <input type="text" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label>Middle name</label>
            <input type="text" class="form-control">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Last name</label>
            <input type="text" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label>Spouse name</label>
            <input type="text" class="form-control">
        </div>
    </div>
</form>