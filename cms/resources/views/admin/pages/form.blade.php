@extends('admin.layout-material')
@section('title', $page->exists ? 'Edit Page' : 'New Page')
@section('content')
    <h1>{{ $page->exists ? 'Edit Page: ' . $page->title : 'New Page' }}</h1>

    <div class="card-box">
        <form method="POST" action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}">
            @csrf
            @if ($page->exists) @method('PUT') @endif

            <label>Slug (URL path, e.g. process/used-equipments)</label>
            <input type="text" name="slug" value="{{ old('slug', $page->slug) }}" required>

            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $page->title) }}" required>

            <label>Meta Description</label>
            <input type="text" name="meta_description" value="{{ old('meta_description', $page->meta_description) }}">

            <label>Template</label>
            <input type="text" name="template" value="{{ old('template', $page->template ?? 'default') }}" required>

            <label><input type="checkbox" name="is_published" value="1" {{ old('is_published', $page->is_published ?? true) ? 'checked' : '' }} style="width:auto;"> Published</label>

            <button type="submit">Save</button>
        </form>
    </div>

    @if ($page->exists)
        <div class="card-box">
            <h2>Sections</h2>
            @foreach ($page->sections as $section)
                <div style="border:1px solid #eee;padding:1rem;border-radius:6px;margin-bottom:1rem;">
                    <form method="POST" action="{{ route('admin.pages.sections.update', [$page, $section]) }}" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <label>Type</label>
                        <select name="type">
                            @foreach (['text','rich_text','image','card_group'] as $type)
                                <option value="{{ $type }}" {{ $section->type === $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                        <label>Heading</label>
                        <input type="text" name="heading" value="{{ $section->heading }}">
                        <label>Body</label>
                        <textarea name="body" rows="3">{{ $section->body }}</textarea>
                        <label>Image (optional)</label>
                        <input type="file" name="image">
                        <button type="submit">Update Section</button>
                    </form>
                    <form method="POST" action="{{ route('admin.pages.sections.destroy', [$page, $section]) }}" onsubmit="return confirm('Delete this section?');" style="margin-top:0.5rem;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-danger">Delete Section</button>
                    </form>

                    @if ($section->type === 'card_group')
                        <h3 style="margin-top:1rem;">Cards</h3>
                        <table>
                            <thead><tr><th>Name</th><th>Description</th><th></th></tr></thead>
                            <tbody>
                                @foreach ($section->cards as $card)
                                    <tr>
                                        <td>{{ $card->name }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($card->description, 60) }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.sections.cards.destroy', [$section, $card]) }}" onsubmit="return confirm('Delete this card?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form method="POST" action="{{ route('admin.sections.cards.store', $section) }}" enctype="multipart/form-data" style="margin-top:1rem;">
                            @csrf
                            <label>New Card Name</label>
                            <input type="text" name="name" required>
                            <label>Description</label>
                            <textarea name="description" rows="2"></textarea>
                            <label>Image</label>
                            <input type="file" name="image">
                            <button type="submit">Add Card</button>
                        </form>
                    @endif
                </div>
            @endforeach

            <form method="POST" action="{{ route('admin.pages.sections.store', $page) }}" enctype="multipart/form-data">
                @csrf
                <h3>Add New Section</h3>
                <label>Type</label>
                <select name="type">
                    <option value="text">text</option>
                    <option value="rich_text">rich_text</option>
                    <option value="image">image</option>
                    <option value="card_group">card_group</option>
                </select>
                <label>Heading</label>
                <input type="text" name="heading">
                <label>Body</label>
                <textarea name="body" rows="3"></textarea>
                <label>Image (optional)</label>
                <input type="file" name="image">
                <button type="submit">Add Section</button>
            </form>
        </div>
    @endif
@endsection
