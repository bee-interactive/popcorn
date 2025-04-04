<x-layouts.public :title=" __('Privacy notice') . ' - Popcorn'">
    @include('partials.page-heading')

    <div class="flex max-w-5xl mx-auto mt-12 h-full w-full flex-1 flex-col gap-4">
        <div class="grid auto-rows-min gap-4">
            <div class="flex flex-col justify-center pb-4">
                <div class="mx-auto">
                    <flux:heading size="xl">{{ __('Privacy notice') }}</flux:heading>

                    <div class="prose mt-12">
                        <p>
                            Effective Date: 2025.04.04
                        </p>
                        <p>
                            Thank you for using our open-source movie and TV show tracking application ("Popcorn"). Your privacy is important to us, and we want to be transparent about how your data is collected and used.
                        </p>
                        <h3>
                            1. Information We Collect
                        </h3>
                        <p>
                            When registering for the Application, we collect the following information:
                        </p>
                        <ul data-spread="false">
                            <li>Name or Username</li>
                            <li>Email Address</li>
                        </ul>
                        <p>
                            No additional personal data is collected beyond what is required for registration.
                        </p>
                        <h3>
                            2. How Your Information Is Used
                        </h3>
                        <p>
                            We use the collected information solely for the purpose of:
                        </p>
                        <ul data-spread="false">
                            <li>Creating and managing your user account</li>
                            <li>Allowing you to save and organize movies and TV shows</li>
                            <li>Providing essential application functionalities</li>
                        </ul>
                        <p>
                            We do <strong>not</strong> use tracking services, analytics, or third-party advertisements.
                        </p>
                        <h3>
                            3. API Calls to TMDB
                        </h3>
                        <p>
                            The Application utilizes The Movie Database (TMDB) API to fetch movie and TV show data. Each user is required to create and use their own TMDB API key to access this functionality. Your API key is stored locally and is not shared with us or any third party.
                        </p>
                        <h3>
                            4. Data Storage and Security
                        </h3>
                        <ul data-spread="false">
                            <li>Your registration details are stored securely within the Application.</li>
                            <li>No payment information is collected, stored, or processed.</li>
                            <li>We take reasonable measures to protect your data but remind users that no system is completely secure.</li>
                        </ul>
                        <h3>
                            5. Open-Source Nature
                        </h3>
                        <p>
                            The Application is open-source, meaning its source code is publicly available. Users are free to review, modify, or contribute to its development. However, we are not responsible for third-party modifications or forks of the software.
                        </p>
                        <h3>
                            6. Data Sharing and Third Parties
                        </h3>
                        <ul data-spread="false">
                            <li>We do not sell, rent, or share your personal data with third parties.</li>
                            <li>The only external service accessed by the Application is TMDB, which requires user-generated API keys.</li>
                        </ul>
                        <h3>
                            7. Your Rights
                        </h3>
                        <p>
                            As a user, you have the right to:
                        </p>
                        <ul data-spread="false">
                            <li>Request deletion of your account and associated data</li>
                            <li>Modify your account details at any time</li>
                        </ul>
                        <h3>
                            8. Contact Information
                        </h3>
                        <p>
                            The Application is developed and maintained by Yves Engetschwiler of Bee Interactive, based in Switzerland. If you have any questions or concerns about this Privacy Notice, you can reach out to us at:
                        </p>
                        <p>
                            popcorn@interactive.swiss
                        </p>
                        <p>
                            By using the Application, you acknowledge and agree to the terms of this Privacy Notice.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>
