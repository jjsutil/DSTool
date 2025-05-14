from fastapi import FastAPI, HTTPException, Query
from fastapi.responses import JSONResponse
from pydantic import BaseModel, ValidationError

from typing import List, Optional

from products_ranker_api.spiders.aliexpress_httpx import query_aliexpress


class SearchRecipe(BaseModel):
    uuid: str
    name: str
    keywords: List[str]
    min_price: float
    max_price: float
    sort_by: Optional[str]
    category: Optional[str]

    class Config:
        allow_population_by_field_name = True
        json_encoders = {
            set: list
        }


app = FastAPI()


@app.get("/search-recipe/")
async def search_recipes(
    uuid: str,
    name: str,
    min_price: float,
    max_price: float,
    keywords: str = Query(..., description="Comma-separated list of keywords"),
    sort_by: Optional[str] = Query(None, description="Query results sorted by"),
    category: Optional[str] = Query(None, description="Category of the products")
):
    if min_price > max_price:
        raise HTTPException(status_code=400, detail="min_price cannot be greater than max_price")

    try:
        search_recipe = SearchRecipe(
            uuid=uuid,
            name=name,
            keywords=keywords.split(','),
            min_price=min_price,
            max_price=max_price,
            sort_by=sort_by,
            category=category
        )
    except ValidationError as e:
        raise HTTPException(status_code=400, detail=f"Invalid input: {e}")

    try:
        search_results = await query_aliexpress(search_recipe)
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"AliExpress query failed: {str(e)}")

    return JSONResponse(content={
        "status": "success",
        "message": "Search recipe successfully executed.",
        "data": search_results.model_dump()
    })
    # methods to crawl URLs (Official APIs hopefully!) from both sources using google lens
    # methods to complete product objects
    # methods to rank
