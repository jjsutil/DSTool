import httpx
from products_ranker_api.models.models import SearchRecipe, SearchResult, Product

BASE_URL = "https://www.aliexpress.com/glosearch/api/product"


async def query_aliexpress(search: SearchRecipe) -> SearchResult:
    params = {
        "SearchText": " ".join(search.keywords),
        "minPrice": search.min_price,
        "maxPrice": search.max_price,
        "SortType": search.sort_by or "default",
        "CategoryId": search.category or "",
        "page": 1,
    }

    products = []
    async with httpx.AsyncClient(timeout=10) as client:
        while True:
            response = await client.get(BASE_URL, params=params)

            if response.status_code != 200:
                raise Exception(f"AliExpress request failed with status code {response.status_code}")

            data = response.json()
            items = data.get("items", [])

            if not items:
                break  # No more items to scrape, exit loop

            for item in items:
                products.append(Product(
                    provider_id=None,
                    name=item.get("title"),
                    category_id=None,
                    sales_quantity=None,
                    price=item.get("price", {}).get("value", 0),
                    currency="USD",
                    review_conclusion=None,
                    stars=None,
                    photo_path=[item.get("image_url")],
                    reviews_count=0,
                    stock_quantity=None,
                    shipping_date=None,
                    shipping_cost=0.0,
                    shipping_currency="USD",
                    created_at="2025-04-11T20:12:05",  # Example timestamp
                    updated_at="2025-04-11T20:12:05"   # Example timestamp
                ))

            params["page"] += 1  # Go to next page

    return SearchResult(
        uuid=search.uuid,
        name=search.name,
        results=products
    )
