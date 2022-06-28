@php
    $attachments = \App\Models\Attachment::where(\App\Constants\Attributes::FORM_ID, $this->record->id)->get();
@endphp
@if(!is_null($attachments))
    <table>
        <tr>
            <td>File</td>
            <td>Link</td>
        </tr>
        @foreach($attachments as $attachment)
        <tr>

                <td>{{ $attachment->file_label }}</td>
                <td>{{ $attachment->path }}</td>

        </tr>
        @endforeach
    </table>
@endif
