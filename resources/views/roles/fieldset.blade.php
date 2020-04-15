<fieldset {{ $attributes }}>

  <legend>{{ $legend }}</legend>

  <x-bs-select :label="$label" name="role" :options="$roles" :values="$value" :required="$required" :disabled="$disabled"/>

</fieldset>
