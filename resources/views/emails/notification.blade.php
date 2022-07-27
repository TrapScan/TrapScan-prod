@component('vendor.mail.html.message')
# Trap *{{ $trap->qr_id }}* Caught a *{{ $inspection->species_caught }}*
## **{{ $user->name }}** inspected it at {{ $inspection->created_at->format('d-m-y H:i:s') }}
@component('vendor.mail.html.table')
| | |
| :---------------- |:-------------|
| **Project**       | {{ $project->name }} |
| **User**          | {{ $user->name }} |
| **Date**          | {{ $inspection->created_at->setTimezone('Pacific/Auckland')->format('d-m-y H:i:s') }} |
| **Caught**        | {{ $inspection->species_caught }} |
| **Trap QR ID**    | {{ $trap->qr_id }} |
| **Trap NZ ID**    | {{ $trap->nz_trap_id }} |
| **Rebaited**      | {{ $inspection->rebaited ? 'Yes' : 'No' }} |
| **Trap Condition**| {{ $inspection->trap_condition }} |
@endcomponent
<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
