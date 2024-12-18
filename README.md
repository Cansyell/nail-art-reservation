
# Snail Studio Laravel 11

Nail art reservation service at Snail Studio using Laravel 11, MySql, Midtrans Payment Gateway.

### Link Demo
https://snailstudio.cansyell.com/

# List of Contents
* Project Installation
* First Configuration
* Route Structure
* Callback Midtrans
* Security and Best Practices





## Installation

Install my-project with git

```bash
git clone https://github.com/Cansyell/nail-art-reservation.git

cd nail-art-reservation
```
install depedensi

```bash
composer install
```
Configurasi Environment
```bash
cp .env.example .env
```
Generate Application Key
```bash
php artisan key:generate
```
Configuration Database
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nail_art_reservation
DB_USERNAME=root
DB_PASSWORD=
```
Migration Database
```bash
php artisan migrate
```
Storage Link
```bash
php artisan storage:link
```
Start Server
```bash
php artisan serve
```
Configuration Midtrans Variable
```bash
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_PRODUCTION=false
```
### Route Web PHP List

| Method | Route                         | Route Name                | Controller                                    | Function                      |
|--------|-------------------------------|---------------------------|-----------------------------------------------|-------------------------------|
| GET    | /                             | front.index               | FrontController::class, 'index'               | landing page                  |
| GET    | /reservation                  | reservation               | ReservationController::class, 'reservation'   | reservation form page         |
| GET    | /reservation/finish           | reservation.finish        | ReservationController::class, 'finish'        | transaction finish page       |
| POST   | /book-appointment             | book.appointment          | ReservationController::class, 'book'          | book appointment process      |
| GET    | /dashboard                    | dashboard                 | Anonymous function (in-line)                  | dashboard page (transactions) |
| GET    | /profile                      | profile.edit              | ProfileController::class, 'edit'              | edit profile page             |
| PATCH  | /profile                      | profile.update            | ProfileController::class, 'update'            | update profile                |
| DELETE | /profile                      | profile.destroy           | ProfileController::class, 'destroy'           | delete profile                |
| GET    | /service                      | service.index             | ServiceController::class, 'index'             | services page                 |
| GET    | /service/create               | service.create            | ServiceController::class, 'create'            | add service page              |
| POST   | /service                      | service.store             | ServiceController::class, 'store'             | save new service              |
| GET    | /service/{service}/edit       | service.edit              | ServiceController::class, 'edit'              | edit service page             |
| PUT    | /service/{service}            | service.update            | ServiceController::class, 'update'            | update service                |
| DELETE | /service/{service}            | service.destroy           | ServiceController::class, 'destroy'           | delete service                |
| GET    | /reservations                 | reservation.index         | ReservationController::class, 'index'         | reservations list page        |
| GET    | /transactions                 | transaction.index         | TransactionController::class, 'index'         | transactions list page        |

### Route API PHP 

| Method | Route           | Route Name    | Controller                             | Function                  |
|--------|-----------------|----------------|----------------------------------------|-------------------------|
| POST   | /callback       | callback       | MidtransController::class, 'callback'  | Callback Midtrans |

### Midtrans Callback Documentation
Endpoint
 
URL: /api/callback
Method: POST
Controller: MidtransController::class, 'callback'

 
Function: callback()

Required Parameters

|Parameter|	Type|	Description| 
|--------|-----------------|----------------|
|order_id	|String|	Unique order ID
|status_code|	String	|Midtrans status code|
|gross_amount|	Numeric	|Total payment amount|
|signature_key|	String	|Signature key for verification|
|transaction_status|	String|	Status of the transaction|

Transaction Statuses
```bash
capture: Payment successful
settlement: Payment completed
pending: Payment is awaiting
deny: Payment denied
cancel: Payment canceled
```
### Callback Process Flow
Validate input parameters:

Ensure that all required parameters are present in the request.
Verify the signature:

Use the ```signature_key``` to verify that the received data has not been modified and is from Midtrans.
Find the transaction in the database:

Retrieve the transaction using the ```order_id``` received in the callback.
Update payment status:

Update the transaction status in the database based on the ```transaction_status``` (capture, settlement, pending, deny, cancel).
Send a response:

Send an appropriate response indicating that the callback was successfully processed.