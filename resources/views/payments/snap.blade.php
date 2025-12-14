@extends('layouts.app')

@section('title', 'Payment - ESEM')
@section('hide-seminar-nav', true)

@push('styles')
<style>
    .payment-page {
        padding: 40px 0;
         background: #ffffff; /* putih */
        min-height: 100vh;
    }

    .payment-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .payment-header {
        text-align: center;
        margin-bottom: 50px;
        animation: fadeInDown 0.6s ease;
    }

    .payment-header h1 {
        font-size: 36px;
        color: #1f2937;
        margin-bottom: 12px;
        font-weight: 700;
        letter-spacing: -0.5px;
    }

    .payment-header p {
        color: #6b7280;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .payment-header p::before {
        content: '🔒';
        font-size: 18px;
    }

    .payment-grid {
        display: grid;
        grid-template-columns: 1fr 420px;
        gap: 30px;
        align-items: start;
    }

    .payment-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 
        0 15px 35px rgba(0, 0, 0, 0.08),
        0 5px 15px rgba(0, 0, 0, 0.05);
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    }


    .payment-card:hover {
        box-shadow: 0 20px 60px rgba(20, 184, 166, 0.1);
        transform: translateY(-2px);
    }

    .card-title {
        font-size: 22px;
        color: #1f2937;
        margin-bottom: 30px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f3f4f6;
    }

    .card-title-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    /* Payment Methods */
    .payment-methods-section {
        margin-bottom: 30px;
    }

    .payment-method-grid {
        display: grid;
        gap: 15px;
        margin-top: 20px;
    }

    .payment-method-option {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 20px 22px;
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fafafa;
        position: relative;
        overflow: hidden;
    }

    .payment-method-option::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(20, 184, 166, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .payment-method-option:hover::before {
        left: 100%;
    }

    .payment-method-option:hover {
        border-color: #14b8a6;
        background: #f0fdfa;
        transform: translateX(5px);
    }

    .payment-method-option.selected {
        border-color: #14b8a6;
        background: linear-gradient(135deg, #ecfdf5 0%, #f0fdfa 100%);
        box-shadow: 0 8px 20px rgba(20, 184, 166, 0.15);
    }

    .payment-method-option input[type="radio"] {
        width: 22px;
        height: 22px;
        accent-color: #14b8a6;
        cursor: pointer;
        flex-shrink: 0;
    }

    .payment-method-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 12px;
        font-size: 24px;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .payment-method-option.selected .payment-method-icon {
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        transform: scale(1.1);
    }

    .payment-method-info {
        flex: 1;
    }

    .payment-method-name {
        font-weight: 700;
        color: #1f2937;
        font-size: 16px;
        margin-bottom: 4px;
    }

    .payment-method-desc {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.4;
    }

    /* Order Summary Sidebar */
    .order-summary {
        position: sticky;
        top: 20px;
    }

    .summary-rows {
        margin: 30px 0;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 0;
        color: #4b5563;
        font-size: 15px;
        border-bottom: 1px dashed #e5e7eb;
    }

    .summary-row:last-child {
        border-bottom: none;
    }

    .summary-row.total {
        border-top: 2px solid #14b8a6;
        border-bottom: none;
        margin-top: 20px;
        padding-top: 25px;
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
    }

    .price-highlight {
        color: #14b8a6;
        font-size: 24px;
        font-weight: 700;
    }

    .summary-row.total .price-highlight {
        font-size: 28px;
    }

    /* Payment Button */
    .btn-pay-now {
        width: 100%;
        padding: 18px;
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        color: white;
        border: none;
        border-radius: 14px;
        font-weight: 700;
        font-size: 17px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(20, 184, 166, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
    }

    .btn-pay-now::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-pay-now:hover::before {
        left: 100%;
    }

    .btn-pay-now:hover {
        background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(20, 184, 166, 0.4);
    }

    .btn-pay-now:active {
        transform: translateY(-1px);
    }

    .btn-pay-now:disabled {
        background: #d1d5db;
        cursor: not-allowed;
        box-shadow: none;
    }

    .btn-pay-now span {
        position: relative;
        z-index: 1;
    }

    /* Security Badge */
    .security-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
        padding: 14px;
        background: linear-gradient(135deg, #f0fdfa 0%, #ecfdf5 100%);
        border-radius: 10px;
        color: #14b8a6;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid #ccfbf1;
    }

    .security-badge::before {
        content: '🔐';
        font-size: 16px;
    }

    /* Payment Instruction */
    .payment-instruction {
        background: linear-gradient(135deg, #fef3c7 0%, #fef9c3 100%);
        border: 2px solid #fbbf24;
        border-radius: 14px;
        padding: 20px;
        margin-top: 25px;
        display: flex;
        gap: 15px;
        align-items: start;
    }

    .payment-instruction-icon {
        font-size: 28px;
        flex-shrink: 0;
    }

    .payment-instruction-text {
        flex: 1;
    }

    .payment-instruction-text h4 {
        color: #92400e;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .payment-instruction-text p {
        color: #78350f;
        font-size: 14px;
        line-height: 1.6;
    }

    /* Loading State */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.97);
        backdrop-filter: blur(5px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .loading-overlay.active {
        display: flex;
    }

    .loading-content {
        text-align: center;
        animation: fadeInScale 0.5s ease;
    }

    .loading-spinner {
        width: 70px;
        height: 70px;
        border: 5px solid #e5e7eb;
        border-top: 5px solid #14b8a6;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 25px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .loading-text {
        color: #1f2937;
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .loading-subtext {
        color: #6b7280;
        font-size: 14px;
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .payment-card {
        animation: fadeInUp 0.6s ease;
    }

    .payment-card:nth-child(2) {
        animation-delay: 0.1s;
    }

    /* Responsive */
    @media (max-width: 968px) {
        .payment-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .order-summary {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .payment-page {
            padding: 30px 0;
        }

        .payment-header h1 {
            font-size: 28px;
        }

        .payment-header p {
            font-size: 14px;
        }

        .payment-card {
            padding: 30px 20px;
            border-radius: 16px;
        }

        .card-title {
            font-size: 20px;
        }

        .payment-method-option {
            padding: 18px;
        }

        .btn-pay-now {
            padding: 16px;
            font-size: 16px;
        }
    }
</style>
@endpush

@section('content')
<div class="payment-page">
    <div class="payment-container">
        <!-- Header -->
        <div class="payment-header">
            <h1>Complete Your Payment</h1>
            <p>Secure payment powered by Midtrans</p>
        </div>

        <div class="payment-grid">
            <!-- Left Column: Payment Method -->
            <div class="payment-card">
                <h2 class="card-title">
                    <div class="card-title-icon">💳</div>
                    Payment Method
                </h2>
                
                <div class="payment-methods-section">
                    <div class="payment-method-grid">
                        <label class="payment-method-option selected" onclick="selectPaymentMethod(this)">
                            <input type="radio" name="payment_method" value="midtrans" checked>
                            <div class="payment-method-icon">💳</div>
                            <div class="payment-method-info">
                                <div class="payment-method-name">Midtrans Gateway</div>
                                <div class="payment-method-desc">Credit Card, E-Wallet, Bank Transfer & More</div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="payment-instruction">
                    <div class="payment-instruction-icon">💡</div>
                    <div class="payment-instruction-text">
                        <h4>Payment Instructions</h4>
                        <p>Click the "Pay Now" button below to proceed with secure payment via Midtrans. You will be redirected to choose your preferred payment method.</p>
                    </div>
                </div>

                <!-- Midtrans Payment Container -->
                <div id="midtrans-payment"></div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="order-summary">
                <div class="payment-card">
                    <h2 class="card-title">
                        <div class="card-title-icon">📋</div>
                        Order Summary
                    </h2>
                    
                    <div class="summary-rows">
                        <div class="summary-row">
                            <span>Event Ticket</span>
                            <span class="price-highlight">Rp {{ number_format($bookingData['event_cost'], 2, ',', '.') }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Processing Fee</span>
                            <span style="color: #10b981; font-weight: 600;">FREE</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total Payment</span>
                            <span class="price-highlight">Rp {{ number_format($bookingData['event_cost'], 2, ',', '.') }}</span>
                        </div>
                    </div>

                    <button id="pay-button" class="btn-pay-now">
                        <span> Pay Now</span>
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
        <div class="loading-spinner"></div>
        <div class="loading-text">Processing your payment...</div>
        <div class="loading-subtext">Please wait, do not close this window</div>
    </div>
</div>

<!-- Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
function selectPaymentMethod(element) {
    document.querySelectorAll('.payment-method-option').forEach(option => {
        option.classList.remove('selected');
    });
    element.classList.add('selected');
    element.querySelector('input[type="radio"]').checked = true;
}

document.getElementById('pay-button').addEventListener('click', function () {
    // Show loading overlay
    document.getElementById('loadingOverlay').classList.add('active');
    
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            console.log('Payment success:', result);
            window.location.href = '{{ route("payment.success") }}';
        },
        onPending: function(result){
            document.getElementById('loadingOverlay').classList.remove('active');
            alert('Pembayaran tertunda. Silakan selesaikan pembayaran Anda.\n\nStatus: ' + result.status_message);
        },
        onError: function(result){
            document.getElementById('loadingOverlay').classList.remove('active');
            alert('Terjadi kesalahan saat memproses pembayaran.\n\nError: ' + result.status_message);
        },
        onClose: function(){
            document.getElementById('loadingOverlay').classList.remove('active');
            console.log('Payment popup closed');
        }
    });
});

// Prevent accidental page reload
window.addEventListener('beforeunload', function (e) {
    if (document.getElementById('loadingOverlay').classList.contains('active')) {
        e.preventDefault();
        e.returnValue = '';
    }
});
</script>
@endsection