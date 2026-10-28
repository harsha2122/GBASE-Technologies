<x-mail::message>
# New enquiry from the GBASE website

**Page:** {{ $pageLabel }}@if($sourcePage['path']) ({{ $sourcePage['path'] }})@endif

@if($sourcePage['inferred'])
Page inferred from the form’s linked page; the original page was not recorded.
@endif
**Form:** {{ $submission->form->name }}

---

@foreach ($submission->values as $value)
**{{ $value->field->label }}:** {{ $value->value }}

@endforeach

---

<x-mail::button :url="config('app.url') . '/admin/forms/' . $submission->form_id . '/submissions/' . $submission->id">
View in Admin Panel
</x-mail::button>
</x-mail::message>
