import scrapy
from datetime import datetime


class AliExpressSpider(scrapy.Spider):
    name = "aliexpress"

    def __init__(self, query=None, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.query = query

    def start_requests(self):
        formatted_query = self.query.replace(" ", "+")
        url = f"https://www.aliexpress.com/wholesale?SearchText={formatted_query}"
        yield scrapy.Request(url, callback=self.parse)

    def parse(self, response, **kwargs):
        now = datetime.utcnow().isoformat()
        products = []

        for item in response.css(".manhattan--container--1lP57Ag"):  # This class might change
            name = item.css("a::attr(title)").get()
            link = item.css("a::attr(href)").get()
            image_list = item.css("img::attr(src)").getall()

            stars = item.css(".star-rating::attr(title)").re_first(r"([\d.]+)")  # Example
            reviews_count = item.css(".feedback-number::text").re_first(r"\d+")
            price = item.css(".price-current::text").re_first(r"[\d.]+")
            currency = "USD"  # AliExpress often shows USD

            shipping_cost = item.css(".manhattan--price-saleTag--2QnvvA5 span::text").re_first(r"[\d.]+")
            shipping_date = None  # Usually inside product page

            products.append({
                "provider_id": None,
                "name": name,
                "category_id": None,
                "sales_quantity": None,
                "price": float(price) if price else None,
                "currency": currency,
                "review_conclusion": None,
                "stars": float(stars) if stars else None,
                "photo_path": image_list,
                "reviews_count": int(reviews_count) if reviews_count else 0,
                "stock_quantity": None,
                "shipping_date": shipping_date,
                "shipping_cost": float(shipping_cost) if shipping_cost else 0.0,
                "shipping_currency": currency,
                "created_at": now,
                "updated_at": now,
            })

        yield {"products": products}

        next_page = response.css("a.next-page::attr(href)").get()
        if next_page:
            yield scrapy.Request(url=next_page, callback=self.parse)
