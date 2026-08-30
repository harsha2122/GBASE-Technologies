{{-- Renders any form purely from its DB-defined fields. Adding/removing
     a field on this form later needs no template change — just edit the
     form_fields rows in the admin panel. --}}
<form action="{{ route('forms.submit', $form) }}" method="POST" enctype="multipart/form-data" class="gbase-contact-form">
    @csrf
    <input type="hidden" name="page_source" value="{{ $pageSource }}">

    @foreach ($form->fields as $field)
        <div class="gbase-form-group">
            <label for="field-{{ $field->name }}">
                {{ $field->label }}
                @if ($field->is_required) <span class="required">*</span> @endif
            </label>

            @switch ($field->type)
                @case ('textarea')
                    <textarea id="field-{{ $field->name }}" name="{{ $field->name }}" @if($field->is_required) required @endif></textarea>
                    @break

                @case ('select')
                    <select id="field-{{ $field->name }}" name="{{ $field->name }}" @if($field->is_required) required @endif>
                        <option value="" disabled selected>Select an option</option>
                        @foreach (($field->options ?? []) as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                    @break

                @case ('checkbox')
                    <input type="checkbox" id="field-{{ $field->name }}" name="{{ $field->name }}" value="1">
                    @break

                @case ('file')
                    <input type="file" id="field-{{ $field->name }}" name="{{ $field->name }}" @if($field->is_required) required @endif>
                    @break

                @default
                    <input type="{{ $field->type }}" id="field-{{ $field->name }}" name="{{ $field->name }}" @if($field->is_required) required @endif>
            @endswitch
        </div>
    @endforeach

    <button type="submit" class="gbase-submit-btn">{{ $form->submit_button_text }}</button>
</form>
