<x-guest-layout>
    <div id="login_page">
        <div>
            <div>
                <form method="POST" action="{{ route('register') }}" id="register">
                    @csrf

                    <!-- Name -->
                    <div>
                        {{-- <x-input-label for="name" :value="__('Name')" /> --}}
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Name" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="">
                        {{-- <x-input-label for="email" :value="__('Email')" /> --}}
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="email" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="">
                        {{-- <x-input-label for="password" :value="__('Password')" /> --}}

                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" placeholder="Password"/>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="">
                        {{-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" /> --}}

                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" placeholder="Re-Password" required />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="">
                        <a class="" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </div>
                    <div class="register_button_div">
                        <x-primary-button class="">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
