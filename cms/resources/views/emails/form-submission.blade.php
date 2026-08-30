<x-mail::message>
# New enquiry from the GBASE website

**Page:** {{ $pageLabel }} ({{ $submission->page_source ?? 'Unknown page' }})
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
