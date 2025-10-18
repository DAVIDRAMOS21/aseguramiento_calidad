<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Update password')" :subheading="auth()->user()->is_superuser ? __('Ensure your account is using a long, random password to stay secure') : __('Password modification is restricted to superusers')">
        @if(auth()->user()->is_superuser)
            <form method="POST" wire:submit="updatePassword" class="mt-6 space-y-6">
                <flux:input
                    wire:model="current_password"
                    :label="__('Current password')"
                    type="password"
                    required
                    autocomplete="current-password"
                />
                <flux:input
                    wire:model="password"
                    :label="__('New password')"
                    type="password"
                    required
                    autocomplete="new-password"
                />
                <flux:input
                    wire:model="password_confirmation"
                    :label="__('Confirm Password')"
                    type="password"
                    required
                    autocomplete="new-password"
                />

                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-end">
                        <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                    </div>

                    <x-action-message class="me-3" on="password-updated">
                        {{ __('Saved.') }}
                    </x-action-message>
                </div>
            </form>
        @else
            <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    Solo los superusuarios pueden modificar contraseñas.
                </div>
            </div>
        @endif
    </x-settings.layout>
</section>
