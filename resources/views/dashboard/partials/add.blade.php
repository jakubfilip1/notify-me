<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Create New Notification') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Add a new reminder quickly and easily in NotifyMe') }}
        </p>
    </header>

    <form method="post" action="{{ route('dashboard.add') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div>
            <x-input-label for="notificationTitle" :value="__('Title')" />
            <input type="text" id="notificationTitle" name="notificationTitle" class="mt-1 block w-full" required />
        </div>

        <div>
            <x-input-label for="notificationContent" :value="__('Content')" />
            <textarea id="notificationContent" name="notificationContent" class="mt-1 block w-full" required></textarea>
        </div>

        <div>
            <x-input-label for="notificationDate" :value="__('Notification Date')" />
            <input type="datetime-local" id="notificationDate" name="notificationDate" class="mt-1 block w-full" required />
        </div>

        <div>
            <x-input-label for="notificationFile" :value="__('File')" />
            <input type="file" id="notificationFile" name="notificationFile" class="mt-1 block w-full" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Create') }}</x-primary-button>
        </div>
    </form>
</section>
