# models.py

from pydantic import BaseModel
from typing import List


class Product(BaseModel):
    title: str
    price: float
    url: str
    image: str


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
