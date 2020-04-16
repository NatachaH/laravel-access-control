<fieldset {{ $attributes }}>

  <legend>{{ $legend }}</legend>

  <x-bs-select :label="$label" name="role" :options="$roles" :selected="$selected" :disabled="$disabled" :required="$required" />

</fieldset>
