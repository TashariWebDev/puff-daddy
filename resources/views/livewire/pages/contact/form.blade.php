<div>
    <form
        wire:submit="sendMessage"
        class="mt-6 space-y-6 w-full"
    >
        <div class="w-full">
            <x-input-label
                for="name"
                :value="__('Name')"
            />
            <x-text-input
                wire:model="name"
                id="name"
                name="name"
                type="text"
                class="block mt-1 w-full"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />
        </div>

        <div>
            <x-input-label
                for="email"
                :value="__('Email')"
            />
            <x-text-input
                wire:model="email"
                id="email"
                name="email"
                type="email"
                class="block mt-1 w-full"
                required
                autocomplete="username"
            />
            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />
        </div>

        <div>
            <x-input-label
                for="phone"
                :value="__('Phone')"
            />
            <x-text-input
                wire:model="phone"
                id="phone"
                name="phone"
                type="text"
                class="block mt-1 w-full"
                required
                autocomplete="phone"
            />
            <x-input-error
                class="mt-2"
                :messages="$errors->get('phone')"
            />
        </div>

        <div class="w-full">
            <x-input-label
                for="company"
                :value="__('Company (optional)')"
            />
            <x-text-input
                wire:model="company"
                id="company"
                name="company"
                type="text"
                class="block mt-1 w-full"
            />
            <x-input-error
                class="mt-2"
                :messages="$errors->get('company')"
            />
        </div>

        <div>
            <x-input-label
                for="message"
                :value="__('Message')"
            />
            <textarea
                wire:model="message"
                id="message"
                name="message"
                type="text"
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                cols="30"
                rows="10"
            ></textarea>
            <x-input-error
                class="mt-2"
                :messages="$errors->get('message')"
            />
        </div>

        <div class="flex gap-4 items-center">
            <x-button class="button-green">{{ __('Send') }}</x-button>
        </div>
    </form>
</div>
