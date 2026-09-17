@php
    $getToothStyle = function (int $number) use ($teeth): string {
        $status = $teeth[$number]->status ?? 'healthy';

        return match ($status) {
            'decay' => 'background-color: #dc2626; color: white;',
            'filled' => 'background-color: #2563eb; color: white;',
            'missing' => 'background-color: #374151; color: white;',
            'root_canal' => 'background-color: #7e22ce; color: white;',
            'crown' => 'background-color: #eab308; color: black;',
            'implant' => 'background-color: #0891b2; color: white;',
            default => 'background-color: transparent; color: inherit;',
        };
    };

    $rows = [
        [[18, 17, 16, 15, 14, 13, 12, 11], [21, 22, 23, 24, 25, 26, 27, 28]],
        [[48, 47, 46, 45, 44, 43, 42, 41], [31, 32, 33, 34, 35, 36, 37, 38]],
    ];
@endphp

<div style="display: flex; flex-direction: column; gap: 1.5rem; align-items: center; width: 100%; overflow-x: auto; padding: 0.5rem;">
    @foreach ($rows as $rowIndex => $row)
        <div style="display: flex; flex-direction: column; gap: 0.75rem; align-items: center;">
            <div style="display: flex; align-items: center; gap: 1rem;">
                @foreach ($row as $quadrant)
                    <div style="display: flex; gap: 0.375rem;">
                        @foreach ($quadrant as $number)
                            <button
                                type="button"
                                wire:click="callMountedAction({ selectedNumber: {{ $number }} })"
                                style="width: 2.5rem; height: 3.2rem; border: 2px solid #6b7280; border-radius: 0.375rem; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; {{ $getToothStyle($number) }}"
                            >
                                {{ $number }}
                            </button>
                        @endforeach
                    </div>

                    @if ($loop->first)
                        <div style="width: 2px; height: 3.2rem; background-color: #9ca3af; border-radius: 9999px; flex-shrink: 0;"></div>
                    @endif
                @endforeach
            </div>

            <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #6b7280;">
                {{ $rowIndex === 0 ? __('Upper Jaw') : __('Lower Jaw') }}
            </span>
        </div>
    @endforeach
</div>