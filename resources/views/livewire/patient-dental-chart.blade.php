@php
    $getToothStyle = function($number) {
        $status = $this->teeth[$number]['status'] ?? 'healthy';
        return match($status) {
            'decay' => 'background-color: #dc2626; color: white;',       // Strong Red
            'filled' => 'background-color: #2563eb; color: white;',      // Strong Blue
            'missing' => 'background-color: #374151; color: white;',     // Dark Gray
            'root_canal' => 'background-color: #7e22ce; color: white;',  // Deep Purple
            'crown' => 'background-color: #eab308; color: black;',       // Strong Yellow/Gold
            'implant' => 'background-color: #0891b2; color: white;',     // Deep Cyan/Teal
            default => 'background-color: transparent; color: inherit;', // Healthy
        };
    };
@endphp

<div style="display: flex; flex-direction: column; align-items: center; gap: 2.5rem; width: 100%; overflow-x: auto; padding: 1.5rem;">
    {{-- Upper Jaw --}}
    <div style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">
        <h3 style="font-size: 0.875rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #6b7280; margin: 0;">
            Upper Jaw
        </h3>

        <div style="display: flex; flex-direction: row; align-items: center; gap: 1.5rem;">
            {{-- Upper Right: 18 to 11 --}}
            <div style="display: flex; flex-direction: row; gap: 0.5rem;">
                @foreach ([18, 17, 16, 15, 14, 13, 12, 11] as $number)
                    <button
                        type="button"
                        wire:click="mountAction('editTooth', { tooth_number: {{ $number }} })"
                        style="width: 3rem; height: 4rem; border: 2px solid #6b7280; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: bold; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); {{ $getToothStyle($number) }}"
                    >
                        {{ $number }}
                    </button>
                @endforeach
            </div>

            {{-- Midline --}}
            <div style="width: 2px; height: 4rem; background-color: #9ca3af; border-radius: 9999px; flex-shrink: 0;"></div>

            {{-- Upper Left: 21 to 28 --}}
            <div style="display: flex; flex-direction: row; gap: 0.5rem;">
                @foreach ([21, 22, 23, 24, 25, 26, 27, 28] as $number)
                    <button
                        type="button"
                        wire:click="mountAction('editTooth', { tooth_number: {{ $number }} })"
                        style="width: 3rem; height: 4rem; border: 2px solid #6b7280; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: bold; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); {{ $getToothStyle($number) }}"
                    >
                        {{ $number }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Lower Jaw --}}
    <div style="display: flex; flex-direction: column; align-items: center; gap: 1rem;">
        <div style="display: flex; flex-direction: row; align-items: center; gap: 1.5rem;">
            {{-- Lower Right: 48 to 41 --}}
            <div style="display: flex; flex-direction: row; gap: 0.5rem;">
                @foreach ([48, 47, 46, 45, 44, 43, 42, 41] as $number)
                    <button
                        type="button"
                        wire:click="mountAction('editTooth', { tooth_number: {{ $number }} })"
                        style="width: 3rem; height: 4rem; border: 2px solid #6b7280; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: bold; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); {{ $getToothStyle($number) }}"
                    >
                        {{ $number }}
                    </button>
                @endforeach
            </div>

            {{-- Midline --}}
            <div style="width: 2px; height: 4rem; background-color: #9ca3af; border-radius: 9999px; flex-shrink: 0;"></div>

            {{-- Lower Left: 31 to 38 --}}
            <div style="display: flex; flex-direction: row; gap: 0.5rem;">
                @foreach ([31, 32, 33, 34, 35, 36, 37, 38] as $number)
                    <button
                        type="button"
                        wire:click="mountAction('editTooth', { tooth_number: {{ $number }} })"
                        style="width: 3rem; height: 4rem; border: 2px solid #6b7280; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: bold; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); {{ $getToothStyle($number) }}"
                    >
                        {{ $number }}
                    </button>
                @endforeach
            </div>
        </div>

        <h3 style="font-size: 0.875rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #6b7280; margin: 0;">
            Lower Jaw
        </h3>
    </div>

    <x-filament-actions::modals />
</div>
