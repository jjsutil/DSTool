from fastapi import FastAPI, HTTPException, Query
from fastapi.responses import JSONResponse
from pydantic import BaseModel, ValidationError

from typing import List, Optional

class SearchRecipe(BaseModel):
    id: str
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
    id: str,
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
            id=id,
            name=name,
            keywords=keywords.split(','),
            min_price=min_price,
            max_price=max_price,
            sort_by=sort_by,
            category=category
        )
    except ValidationError as e:
        raise HTTPException(status_code=400, detail=f"Invalid input: {e}")

    response = {
        "status": "success",
        "message": "Search recipe parameters successfully processed.",
        "data": search_recipe.dict()
    }

# methods to crawl URLs (Official APIs hopefully!) from both sources using google lens
# methods to complete product objects
# methods to rank
    return JSONResponse(content=response)
