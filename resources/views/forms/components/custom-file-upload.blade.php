@php
    $attachments = \App\Models\Attachment::where(\App\Constants\Attributes::FORM_ID, $this->record->id)->get();
@endphp
<table>
    <tbody>
    @foreach($attachments as $attachment)
        <tr role="row">
            <td style="vertical-align: middle;" width="450px">{{ $attachment->file_label }}</td>
            <td>
                <button class="font-bold py-2 px-4 rounded inline-flex items-center" onclick="window.open('{{ $attachment->url }}', '_blank')">
                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                    <span>Download</span>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
