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
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Payment Successful!</h1>
            <p class="text-gray-600 mb-6">
              {{ $message }}
            </p>
          @elseif($transactionStatus === 'pending')
            <!-- Pending State -->
            <div class="flex justify-center mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Payment Pending</h1>
            <p class="text-gray-600 mb-6">
               {{ $message }}
            </p>
          @else
            <!-- Failed State -->
            <div class="flex justify-center mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Payment Failed</h1>
            <p class="text-gray-600 mb-6">
               {{ $message }}
            </p>
          @endif
          
          <div class="mb-8 border rounded-lg p-4 bg-gray-50">
            <p class="text-gray-700 mb-2">
              <strong>Transaction ID:</strong> {{ $transactionId }}
            </p>
            <p class="text-gray-700 mb-2">
              <strong>Order ID:</strong> {{ $orderId }}
            </p>
            <p class="text-gray-700">
              <strong>Total Amount:</strong> Rp {{ number_format($totalAmount, 0, ',', '.') }}
            </p>
          </div>
          
          <div class="space-y-4">
            @if($transactionStatus === 'success')
              <a href="{{ route('front.index') }}" 
                class="inline-block w-full bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out">
                Back to Home
              </a>
            @elseif($transactionStatus === 'pending')
              <a href="javascript:history.back()" 
                class="inline-block w-full bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-300 ease-in-out">
                Return to Payment Page
              </a>
            @else
              <p class="text-red-600 font-medium mb-4">Please try your payment again</p>
              <a href="javascript:history.back()" 
                class="inline-block w-full bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out">
                Retry Payment
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </body>
</html>