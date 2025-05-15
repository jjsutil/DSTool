# models.py

from pydantic import BaseModel
from typing import List, Optional


class Product(BaseModel):
    provider_id: Optional[str] = None
    name: str
    category_id: Optional[str] = None
    sales_quantity: Optional[int] = None
    price: float
    currency: str = "USD"
    review_conclusion: Optional[str] = None
    stars: Optional[float] = None
    photo_path: List[str]
    reviews_count: int
    stock_quantity: Optional[int] = None
    shipping_date: Optional[str] = None
    shipping_cost: float
    shipping_currency: str = "USD"
    created_at: str
    updated_at: str

class SearchRecipe(BaseModel):
    uuid: str
    name: str
    keywords: List[str]
    min_price: float
    max_price: float
    sort_by: str
    category: str


class SearchResult(BaseModel):
    uuid: str
    name: str
    results: List[Product]
