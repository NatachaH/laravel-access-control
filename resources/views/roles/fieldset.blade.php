<fieldset {{ $attributes }}>

  <legend>{{ $legend }}</legend>

  <x-bs-select :label="$label" name="role" :options="$roles" :selected="$value" :disabled="$disabled" :required="$required" />

</fieldset>
