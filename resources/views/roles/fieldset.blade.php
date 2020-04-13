<fieldset {{ $attributes }}>

  <legend>{{ $legend }}</legend>

  <div class="row">

    <x-bs-select class="col-12" :label="$label" name="role" :options="$roles" :value="$value" :required=$isRequired/>

  </div>

</fieldset>
