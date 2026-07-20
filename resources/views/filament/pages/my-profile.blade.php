<x-filament-panels::page>
    @if (!$isProfileComplete)
        <div class="p-4 mb-6 rounded-lg bg-danger-50 border border-danger-200 dark:bg-danger-950 dark:border-danger-800"
            style="background-color: #fef2f2; border-color: #fecaca;">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-3" style="display: flex; align-items: center; gap: 12px;">
                    <span class="p-2 rounded-full bg-danger-100 text-danger-600"
                        style="background-color: #fee2e2; color: #dc2626; padding: 8px; border-radius: 9999px; display: inline-flex; width: 40px; height: 40px; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 24px; height: 24px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </span>
                    <div>
                        <h3 class="text-sm font-medium text-danger-800"
                            style="color: #991b1b; font-size: 14px; font-weight: 500;">Data Profil Belum Lengkap!</h3>
                        <p class="text-xs text-danger-600" style="color: #b91c1c; font-size: 12px;">Anda wajib mengisi
                            seluruh informasi biodata diri di bawah ini untuk dapat melanjutkan ke tahap pendaftaran
                            program pelatihan.</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="p-4 mb-6 rounded-lg bg-success-50 border border-success-200 dark:bg-success-950 dark:border-success-800"
            style="background-color: #f0fdf4; border-color: #bbf7d0;">
            <div class="flex items-center gap-3" style="display: flex; align-items: center; gap: 12px;">
                <span class="p-2 rounded-full bg-success-100 text-success-600"
                    style="background-color: #dcfce7; color: #16a34a; padding: 8px; border-radius: 9999px; display: inline-flex; width: 40px; height: 40px; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 24px; height: 24px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <div>
                    <h3 class="text-sm font-medium text-success-800"
                        style="color: #166534; font-size: 14px; font-weight: 500;">Profil Anda Sudah Valid</h3>
                    <p class="text-xs text-success-600" style="color: #15803d; font-size: 12px;">Terima kasih telah
                        melengkapi data profil Anda. Anda dapat mengubah data ini kapan saja jika ada perubahan data
                        fisik.</p>
                </div>
            </div>
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        {{ $this->form }}

        <div class="flex justify-end">
            <x-filament::button type="submit" color="{{ $isProfileComplete ? 'primary' : 'danger' }}">
                {{ $isProfileComplete ? 'Perbarui Profil' : 'Lengkapi Profil Sekarang' }}
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
