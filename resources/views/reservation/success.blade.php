<!DOCTYPE html>
<html>
  <head>
    <title>Transaction Status</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100">
    <div class="container mx-auto px-4 mt-20">
      <div class="max-w-md mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-8 text-center">
          @if($transactionStatus === 'success')
            <!-- Success State -->
            <div class="flex justify-center mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Transaction Successful</h1>
            <p class="text-gray-600 mb-6">
              Thank you for your appointment, please screenshot this page for confirmation.
            </p>
          @elseif($transactionStatus === 'pending')
            <!-- Pending State -->
            <div class="flex justify-center mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Transaction Pending</h1>
            <p class="text-gray-600 mb-6">
              Your transaction is being processed. Please wait while we confirm your payment.
            </p>
          @else
            <!-- Failed State -->
            <div class="flex justify-center mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Transaction Failed</h1>
            <p class="text-gray-600 mb-6">
              We're sorry, but your transaction could not be completed. Please try again or contact support.
            </p>
          @endif
          
          <div class="mb-4">
            <p class="text-gray-700">
              <strong>Transaction ID:</strong> {{ $transactionId }}
            </p>
            <p class="text-gray-700">
              <strong>Order ID:</strong> {{ $orderId }}
            </p>
            <p class="text-gray-700">
              <strong>Total Amount:</strong> Rp {{ number_format($totalAmount, 2) }}
            </p>
            @if($transactionStatus === 'failed')
              <p class="text-red-600 mt-2">
                <strong>Error Message:</strong> {{ $errorMessage }}
              </p>
            @endif
          </div>
          
          <div class="space-x-4">
            <a 
              href="/" 
              class="inline-block bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition duration-300 ease-in-out"
            >
              Return to Homepage
            </a>
            
            @if($transactionStatus === 'failed')
              <h1>FAILED</h1>
            @endif
          </div>
        </div>
      </div>
    </div>
  </body>
</html>