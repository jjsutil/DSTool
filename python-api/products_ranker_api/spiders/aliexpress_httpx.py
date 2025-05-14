import httpx
import asyncio
import logging
import urllib.parse
from datetime import datetime
from typing import List
from selectolax.parser import HTMLParser

from products_ranker_api.models.models import SearchRecipe, SearchResult, Product

logger = logging.getLogger(__name__)

BASE_URL = "https://www.aliexpress.com/wholesale"

MAX_RESULTS = 2  # Limit the number of results returned

def build_search_url(search: SearchRecipe, page: int = 1) -> str:
    search_text = "+".join(search.keywords)
    query = {
        "SearchText": search_text,
        "page": page,
    }
    if search.sort_by:
        query["SortType"] = search.sort_by
    if search.category:
        query["CategoryId"] = search.category

    query_string = urllib.parse.urlencode(query)
    return f"{BASE_URL}?{query_string}"

def parse_card_to_product(card) -> Product:
    now = datetime.utcnow().isoformat()

    # Title
    title_node = card.css_first("h3")
    title = title_node.text(strip=True) if title_node else "Unknown"

    # Price and currency
    price_node_container = card.css_first(".jr_kr")
    price, currency = 0.0, "USD"
    if price_node_container:
        spans = price_node_container.css("span")
        if spans:
            currency = spans[0].text(strip=True) if spans[0] else "USD"
            price_text = "".join([s.text(strip=True) for s in spans[1:]])
            try:
                price = float(price_text)
            except ValueError:
                pass
    # Image
    image_node = card.css_first("img")
    image_url = image_node.attributes.get("src") if image_node else ""
    if image_url and image_url.startswith("//"):
        image_url = "https:" + image_url

    # Stars
    stars_node = card.css_first(".jr_kf")
    stars = float(stars_node.text(strip=True)) if stars_node else None

    # Reviews count
    reviews_node = card.css_first(".jr_j7")
    reviews_count = 0
    if reviews_node:
        try:
            reviews_count = int(reviews_node.text(strip=True).replace("+", "").replace(".", "").replace(" vendidos", ""))
        except ValueError:
            pass

    return Product(
        provider_id=None,
        name=title,
        category_id=None,
        sales_quantity=None,
        price=price,
        currency=currency,
        review_conclusion=None,
        stars=stars,
        photo_path=[image_url] if image_url else [],
        reviews_count=reviews_count,
        stock_quantity=None,
        shipping_date=None,
        shipping_cost=0.0,
        shipping_currency="USD",
        created_at=now,
        updated_at=now
    )

async def query_aliexpress(search: SearchRecipe) -> SearchResult:
    products: List[Product] = []
    page = 1

    headers = {
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 "
                      "(KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36",
        "Accept": "text/html",
    }

    async with httpx.AsyncClient(timeout=15, headers=headers) as client:
        while len(products) < MAX_RESULTS:
            url = build_search_url(search, page)
            try:
                response = await client.get(url, follow_redirects=True)
                response.raise_for_status()

                html = response.text
                tree = HTMLParser(html)
                product_cards = tree.css(".search-item-card-wrapper-gallery")

                if not product_cards:
                    logger.info(f"No more products found on page {page}.")
                    break

                for card in product_cards:
                    if len(products) >= MAX_RESULTS:
                        break
                    product = parse_card_to_product(card)
                    products.append(product)

                logger.info(f"Page {page} scraped with {len(product_cards)} products.")
                page += 1
                await asyncio.sleep(1.5)

            except httpx.HTTPStatusError as e:
                logger.error(f"Request failed on page {page}: {str(e)}")
                break
            except Exception as e:
                logger.exception(f"Unexpected error on page {page}: {str(e)}")
                break

    return SearchResult(
        uuid=search.uuid,
        name=search.name,
        results=products
    )
