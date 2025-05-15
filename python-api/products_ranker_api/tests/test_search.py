import pytest
from httpx import AsyncClient, ASGITransport
from products_ranker_api.main import app


@pytest.mark.asyncio
async def test_search_recipe_returns_products():
    transport = ASGITransport(app=app)
    async with AsyncClient(transport=transport, base_url="http://test") as client:
        response = await client.get("/search-recipe/", params={
            "uuid": "test-001",
            "name": "usb-test",
            "min_price": 0,
            "max_price": 10000,
            "keywords": "usb"
        })
        assert response.status_code == 200
        data = response.json()

        assert data["status"] == "success"
        results = data["data"]["results"]
        assert isinstance(results, list)
        assert len(results) >= 2

        for product in results:
            assert isinstance(product["name"], str)
            assert len(product["name"]) > 0

            assert isinstance(product["price"], (int, float))
            assert product["price"] > 0

            assert isinstance(product["currency"], str)
            assert len(product["currency"]) >= 2

            assert isinstance(product["photo_path"], list)
            assert all(isinstance(url, str) for url in product["photo_path"])
