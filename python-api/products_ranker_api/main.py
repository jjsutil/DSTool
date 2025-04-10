
from pydantic import BaseModel
from typing import List, Optional

from fastapi import FastAPI, HTTPException
from fastapi.responses import JSONResponse
from pydantic import ValidationError

class SearchRecipe(BaseModel):
    id: str
    name: str
    keywords: List[str]
    min_price: float
    max_price: float
    sort_by: str
    category: str

    class Config:
        allow_population_by_field_name = True
        json_encoders = {
            set: list
        }

app = FastAPI()

@app.get("/search-recipes")
async def search_recipes(
    id: str,
    name: str,
    keywords: str,
    min_price: float,
    max_price: float,
    sort_by: str,
    category: str
):
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
        "data": {
            "id": search_recipe.id,
            "name": search_recipe.name,
            "keywords": search_recipe.keywords,
            "min_price": search_recipe.min_price,
            "max_price": search_recipe.max_price,
            "sort_by": search_recipe.sort_by,
            "category": search_recipe.category,
        }
    }

    return JSONResponse(content=response)
