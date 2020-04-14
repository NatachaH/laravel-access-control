<fieldset {{ $attributes }}>

  <legend>{{ $legend }}</legend>

  <x-bs-select :label="$label" name="role" :options="$roles" :value="$value" :required=$isRequired/>

</fieldset>
