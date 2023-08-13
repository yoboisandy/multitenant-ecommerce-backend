Thanks,<br />
@if (tenant())
    {{ ucWords(tenant('store_name')) }} Team
@else
Mecomm Team
@endif