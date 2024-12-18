<!DOCTYPE html>
<html>
  <head>
    <title>Transaction Successful</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100">
    <div class="container mx-auto px-4 mt-20">
      <div class="max-w-md mx-auto">
        <div class="bg-white shadow-lg rounded-lg p-8 text-center">
          <div class="flex justify-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          
          <h1 class="text-3xl font-bold text-gray-800 mb-4">Transaction Successful</h1>
          
          <p class="text-gray-600 mb-6">
            Thank you for your appointment, please screenshot this page for confirmation.
          </p>
          
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
          </div>
          
          <a 
            href="/" 
            class="inline-block bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out"
          >
            Return to Homepage
          </a>
        </div>
      </div>
    </div>
  </body>
</html>