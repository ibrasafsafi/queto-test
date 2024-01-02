# Stock Alimentaires App (Queto) - Laravel 10

## How To Install

### The requirements

- PHP 8.*
- Composer
- NodeJS

### Installation Process

To install the project, follow these steps:

1. Clone the repository from github public repository ('https://github.com/ibrasafsafi/queto-test/')
2. Run `composer install`
3. Run `npm install`
4. Run `npm run dev`
5. Run `php artisan migrate`
6. Run `php artisan db:seed`
7. Run `php artisan serve`
8. Go to `http://localhost:8000`
9. Login with `admin@admin.com` and `password`
10. Use the app!

### Use Postman to test the API

use the `Queto.postman_collection.json` file to import the postman collection

## API Documentation

All API routes are prefixed with `/api/queto`.
You should use the bearer token authentication method to authenticate your requests.

### API Authentication

| Method | URI     | Action |
|--------|---------|--------|
| POST   | /login  | Login  |
| POST   | /logout | Logout |

### API Routes

<table>
<tr>
<th>Method</th>
<th>URI</th>
<th>Description</th>
<th>Payload</th>
</tr>

<tr>
<td>GET</td>
<td>/products</td>
<td>Get all products from the user stock articles on the database</td>
<td></td>
</tr>

<tr>
<td>POST</td>
<td>/products</td>
<td>Add a product to the user stock</td>
<td>

```json
{
  "product_id": 1,
  "quantity": 1,
  "expiration_date": "2025-01-01"
}
```

</td>

</tr>

<tr>
<td>GET</td>
<td>/recipes</td>
<td>get all recipes that can be made based on the user's stock articles and the recipe ingredients</td>
<td></td>
</tr>

<tr>
<td>POST</td>
<td>/recipes/{recipe}</td>
<td>validate if we can make this recipe based on the user's stock articles and decrease the quantity of the stock articles </td>
<td></td>
</tr>
</table>
