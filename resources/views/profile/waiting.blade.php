@extends('layouts.app')

@section('navBar')
    {{-- Leave this section empty to exclude the sidebar --}}
@endsection
@section('footer')
    {{-- Leave this section empty to exclude the sidebar --}}
@endsection

@section('content')
    <div class="container py-5 text-center">
        <h3>Awaiting M-Pesa Payment Confirmation...</h3>
        <p class="text-muted">Check your phone and approve the M-pesa prompt.</p>

        <div id="spinner" class="spinner-border text-primary my-4" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>

        <p id="statusMessage" class="text-muted">Still waiting...</p>

        <button id="retryBtn" class="btn btn-outline-primary mt-3 d-none">Retry Payment</button>

        <script>
            const paymentId = "{{ $payment_id }}";
            const checkUrl = "{{ route('mpesa.status.check') }}";
            const bookingsUrl = "{{ route('profile.show') }}";
            const retryUrl = "{{ route('subscription.retry', ['id' => $booking_id]) }}";

            let attempt = 0;
            const maxAttempts = 5;

            const statusMessage = document.getElementById('statusMessage');
            const retryBtn = document.getElementById('retryBtn');
            const spinner = document.getElementById('spinner');

            const pollInterval = setInterval(() => {
                fetch(`${checkUrl}?id=${paymentId}`, {
                        credentials: 'same-origin' // ✅ Send cookies/session headers
                    })
                    .then(response => response.json())
                    .then(data => {
                        attempt++;
                        if (data.status === 'Completed') {
                            clearInterval(pollInterval);
                            statusMessage.textContent = '✅ Payment confirmed! Redirecting...';
                            setTimeout(() => window.location.href = bookingsUrl, 2000);
                        } else if (data.status === 'Failed') {
                            clearInterval(pollInterval);
                            statusMessage.textContent = '❌ Payment failed. Please try again.';
                            retryBtn.classList.remove('d-none');
                            spinner.classList.add('d-none');
                        } else if (attempt >= maxAttempts) {
                            clearInterval(pollInterval);
                            statusMessage.textContent = '⏱ Payment taking longer than expected. Please try again.';
                            retryBtn.classList.remove('d-none');
                            spinner.classList.add('d-none');
                        } else {
                            statusMessage.textContent = `⌛ Attempt ${attempt} of ${maxAttempts}...`;
                        }
                    })
                    .catch(error => {
                        clearInterval(pollInterval);
                        statusMessage.textContent = '⚠️ Error checking status. Please try again.';
                        retryBtn.classList.remove('d-none');
                        spinner.classList.add('d-none');
                        console.error(error);
                    });
            }, 5000); 

            retryBtn.addEventListener('click', () => {
                window.location.href = retryUrl;
            });
        </script>
    </div>
@endsection
