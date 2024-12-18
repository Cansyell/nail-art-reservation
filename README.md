
# Snail Studio Laravel 11

Nail art reservation service at Snail Studio using Laravel 11, MySql, Midtrans Payment Gateway.

# Daftar Isi
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

| Method | Route                         | Nama Route                | Controller                                    | Fungsi                       |
|--------|-------------------------------|---------------------------|-----------------------------------------------|------------------------------|
| GET    | /                             | front.index               | FrontController::class, 'index'               | halaman landing page         |
| GET    | /reservation                  | reservation               | ReservationController::class, 'reservation'   | halaman form reservation     |
| GET    | /reservation/finish           | reservation.finish        | ReservationController::class, 'finish'        | halaman finish transaksi     |
| POST   | /book-appointment             | book.appointment          | ReservationController::class, 'book'          | proses pemesanan appointment |
| GET    | /dashboard                    | dashboard                 | Anonymous function (in-line)                  | halaman dashboard (transaksi)|
| GET    | /profile                      | profile.edit              | ProfileController::class, 'edit'              | halaman edit profil          |
| PATCH  | /profile                      | profile.update            | ProfileController::class, 'update'            | update profil                |
| DELETE | /profile                      | profile.destroy           | ProfileController::class, 'destroy'           | hapus profil                 |
| GET    | /service                      | service.index             | ServiceController::class, 'index'             | halaman layanan              |
| GET    | /service/create               | service.create            | ServiceController::class, 'create'            | halaman tambah layanan       |
| POST   | /service                      | service.store             | ServiceController::class, 'store'             | simpan layanan baru          |
| GET    | /service/{service}/edit       | service.edit              | ServiceController::class, 'edit'              | halaman edit layanan         |
| PUT    | /service/{service}            | service.update            | ServiceController::class, 'update'            | update layanan               |
| DELETE | /service/{service}            | service.destroy           | ServiceController::class, 'destroy'           | hapus layanan                |
| GET    | /reservations                 | reservation.index         | ReservationController::class, 'index'         | halaman daftar reservasi     |
| GET    | /transactions                 | transaction.index         | TransactionController::class, 'index'         | halaman daftar transaksi     |

### Route API PHP 

| Method | Route           | Nama Route     | Controller                             | Fungsi                  |
|--------|-----------------|----------------|----------------------------------------|-------------------------|
| POST   | /callback       | callback       | MidtransController::class, 'callback'  | menerima callback dari Midtrans |

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