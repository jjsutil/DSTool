<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
# DSTool

### Schema for E-commerce Product Analytics

| **Table Name**          | **Column Name**                  | **Data Type**         | **Default Value**        | **Comments**                              |
|-------------------------|----------------------------------|-----------------------|--------------------------|-------------------------------------------|
| `products`              | `id`                             | `INT PRIMARY KEY`     |                          | Unique identifier for the product         |
|                         | `name`                           | `VARCHAR(255)`         |                          | Product name                              |
|                         | `category`                       | `VARCHAR(255)`         |                          | Category of the product                   |
|                         | `description`                    | `TEXT`                 |                          | Description of the product                |
|                         | `provider_id`                    | `INT`                  |                          | ID of the product provider                |
|                         | `created_at`                     | `TIMESTAMP`            | `CURRENT_TIMESTAMP`       | When the product was added to the system  |
| `product_prices`        | `id`                             | `INT PRIMARY KEY`     |                          | Unique identifier for the product price   |
|                         | `product_id`                     | `INT`                  |                          | Foreign key to `products`                 |
|                         | `price`                          | `DECIMAL(10,2)`        |                          | Product price                             |
|                         | `provider_price`                 | `DECIMAL(10,2)`        |                          | Provider's price                          |
|                         | `timestamp`                      | `TIMESTAMP`            | `CURRENT_TIMESTAMP`       | Timestamp of the price                    |
| `competitor_prices`     | `id`                             | `INT PRIMARY KEY`     |                          | Unique identifier for competitor prices   |
|                         | `product_id`                     | `INT`                  |                          | Foreign key to `products`                 |
|                         | `competitor_price`               | `DECIMAL(10,2)`        |                          | Competitor's price                        |
|                         | `timestamp`                      | `TIMESTAMP`            | `CURRENT_TIMESTAMP`       | Timestamp of the competitor's price       |
| `sales`                 | `id`                             | `INT PRIMARY KEY`     |                          | Unique identifier for the sale            |
|                         | `product_id`                     | `INT`                  |                          | Foreign key to `products`                 |
|                         | `quantity_sold`                  | `INT`                  |                          | Quantity of the product sold              |
|                         | `sale_price`                     | `DECIMAL(10,2)`        |                          | Sale price of the product                 |
|                         | `timestamp`                      | `TIMESTAMP`            | `CURRENT_TIMESTAMP`       | Timestamp of the sale                     |
| `sales_per_period`      | `id`                             | `INT PRIMARY KEY`     |                          | Unique identifier for the sales period    |
|                         | `product_id`                     | `INT`                  |                          | Foreign key to `products`                 |
|                         | `total_sales`                    | `INT`                  |                          | Total number of sales in the period       |
|                         | `total_quantity_sold`            | `INT`                  |                          | Total quantity of products sold in period |
|                         | `period`                         | `VARCHAR(255)`         |                          | The period for sales aggregation (e.g., week, month) |
| `reviews`               | `id`                             | `INT PRIMARY KEY`     |                          | Unique identifier for the review          |
|                         | `product_id`                     | `INT`                  |                          | Foreign key to `products`                 |
|                         | `rating`                         | `DECIMAL(3,2)`         |                          | Rating given by the customer              |
|                         | `review_text`                    | `TEXT`                 |                          | Review text                               |
| `competitors`           | `id`                             | `INT PRIMARY KEY`     |                          | Unique identifier for competitors         |
|                         | `name`                           | `VARCHAR(255)`         |                          | Competitor name                           |
|                         | `rating`                         | `DECIMAL(3,2)`         |                          | Rating of the competitor                  |
|                         | `reviews_count`                  | `INT`                  |                          | Number of reviews                         |
| `stock`                 | `id`                             | `INT PRIMARY KEY`     |                          | Unique identifier for stock               |
|                         | `product_id`                     | `INT`                  |                          | Foreign key to `products`                 |
|                         | `stock_quantity`                 | `INT`                  |                          | Quantity of stock available               |
|                         | `restock_date`                   | `DATE`                 |                          | Date of next restock                      |
| `shipping`              | `id`                             | `INT PRIMARY KEY`     |                          | Unique identifier for shipping            |
|                         | `product_id`                     | `INT`                  |                          | Foreign key to `products`                 |
|                         | `shipping_cost`                  | `DECIMAL(10,2)`        |                          | Cost for shipping                         |
|                         | `timestamp`                      | `TIMESTAMP`            | `CURRENT_TIMESTAMP`       | Timestamp of the shipping cost            |


### Summary of KPIs

| **KPI Group**               | **KPI**                                             | **Table**                   | **Columns**                                  |
|-----------------------------|-----------------------------------------------------|-----------------------------|----------------------------------------------|
| **Demand Indicators**        | 1. Sales Volume, 2. Sales Growth, 3. Sales Frequency| `sales`, `sales_per_period`  | `quantity_sold`, `total_sales`, `period`     |
| **Pricing and Profitability**| 4. Price Variability, 5. Profit Margin, 6. Price Difference, 7. Avg Profit per Sale | `product_prices`, `competitor_prices`, `sales` | `price`, `competitor_price`, `sale_price`    |
| **Competition Analysis**     | 8. Competitor Price Comparison, 9. Market Share, 10. Competitor Rating | `competitor_prices`, `competitors`, `sales` | `competitor_price`, `quantity_sold`, `rating`|
| **Quality and Appeal**      | 11. Product Rating, 12. Review Sentiment           | `reviews`                   | `rating`, `review_text`                      |
| **Trend and Time**          | 13. Price Trend, 14. Sales Trend                   | `product_prices`, `sales`   | `price`, `quantity_sold`, `timestamp`        |
| **Consumer Behavior**       | 15. Purchase Frequency, 16. Avg Quantity per Consumer | `sales`, `sales_per_period` | `quantity_sold`, `total_sales`               |
| **Market Opportunity**      | 17. Stock Availability, 18. Restock Trends         | `stock`                     | `stock_quantity`, `restock_date`             |
| **Historical Data**         | Historical Performance                             | `sales`, `product_prices`, `competitor_prices` | `timestamp`, `quantity_sold`, `price`        |
| **Operational Factors**     | Stock and Shipping                                 | `stock`, `shipping`         | `stock_quantity`, `shipping_cost`            |
| **Advanced Metrics**        | Complex Data Analysis                              | `sales`, `product_prices`, `competitor_prices` | `quantity_sold`, `price`, `competitor_price` |
| **Data Aggregation**        | Consolidated Views                                 | `sales_per_period`          | `total_sales`, `total_quantity_sold`         |


>>>>>>> 5aeadb3fd0331a2a333be06370cbb38caf1e12b6
