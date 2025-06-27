<x-admin::form.control-group.control
    type="text"
    :id="$attribute->code"
    :name="$attribute->code"
    :value="old($attribute->code) ?? (is_numeric($value) ? number_format($value, 0, '.', ',') : $value)"
    :rules="$validations"
    :label="$attribute->name"
/>