from products_ranker_api.main import SearchRecipe
from pydantic import ValidationError
import logging

logger = logging.getLogger(__name__)


def test_valid_search_recipe():
    logger.info("✅ This is a logged info message.")
    payload = {
        "uuid": "abc-123",
        "name": "test recipe",
        "keywords": "usb,bluetooth,adapter",
        "min_price": 5.0,
        "max_price": 20.0,
        "sort_by": "price",
        "category": "electronics"
    }

    recipe = SearchRecipe(
        uuid=payload["uuid"],
        name=payload["name"],
        keywords=payload["keywords"].split(','),
        min_price=payload["min_price"],
        max_price=payload["max_price"],
        sort_by=payload["sort_by"],
        category=payload["category"]
    )

    assert recipe.name == "test recipe"
    assert recipe.min_price == 5.0
    assert len(recipe.keywords) == 3


def test_invalid_price_range():
    try:
        SearchRecipe(
            uuid="abc-123",
            name="invalid",
            keywords=["usb"],
            min_price=50.0,
            max_price=10.0
        )
    except ValidationError:
        assert True
    else:
        raise AssertionError("ValidationError was not raised when min_price > max_price")


def test_valid_search_recipe():
    logger.info("✅ This is a logged info message.")
    payload = {
        "uuid": "abc-123",
        "name": "test recipe",
        "keywords": "usb,bluetooth,adapter",
        "min_price": 5.0,
        "max_price": 20.0,
        "sort_by": "price",
        "category": "electronics"
    }

    recipe = SearchRecipe(
        uuid=payload["uuid"],
        name=payload["name"],
        keywords=payload["keywords"].split(','),
        min_price=payload["min_price"],
        max_price=payload["max_price"],
        sort_by=payload["sort_by"],
        category=payload["category"]
    )

    assert recipe.name == "test recipe"
    assert recipe.min_price == 5.0
    assert len(recipe.keywords) == 3

# expected output:

#{
#  "provider_id": null,
#  "name": "Notebook Vintage Style",
#  "category_id": null,
#  "sales_quantity": 1200,
#  "price": 3.99,
#  "currency": "USD",
#  "review_conclusion": "Most customers satisfied",
#  "stars": 4.7,
#  "photo_path": [
#    "https://ae01.alicdn.com/kf/H123abc456.jpg",
#    "https://ae01.alicdn.com/kf/H123abc457.jpg"
#  ],
#  "reviews_count": 315,
#  "stock_quantity": null,
#  "shipping_date": 15,
#  "shipping_cost": 1.5,
#  "shipping_currency": "USD",
#  "created_at": "2025-04-11T20:12:05",
#  "updated_at": "2025-04-11T20:12:05"
#}
