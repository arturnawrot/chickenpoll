<form>
    <div class="row">
        <div class="col-md-6">
            <div class="form-check">
                <input name="settings[]" value="ip_checking" type="checkbox" class="checkmark" id="exampleCheck1" {{ (int)$poll->hasSetting('ip_checking') == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="exampleCheck1">IP checking</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check">
                <input name="settings[]" value="captcha" type="checkbox" class="checkmark" id="2">
                <label class="form-check-label" for="2">Google Captcha</label>
            </div>
            <div class="form-check">
                <input name="settings[]" value="multiple_choice" type="checkbox" class="checkmark" id="3">
                <label class="form-check-label" for="3">Multiple choice</label>
            </div>
        </div>
    </div>
</form>

