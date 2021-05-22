# Verification Service

This API service is the example codes for the PrimeXConnect Backend Developer API and coding challenge.

## Development

## Requirements
### 1. Create a new Laravel/Lumen Project.
I chose `"laravel/framework": "^8.40"` and `"cloudcreativity/laravel-json-api": "^3.3"` instead.

### 2. Setup a database using the following diagram.
Can be found [here](./sql).

### 3. Create the following API routes
- Add, Update, Delete product.

???????????????????????????? more ?????????????????????








## URI

```sh
https://api.primex.io/premex-api/v1
```

## Resources

### Products
#### Product create
```
> POST /premex-api/v1/products
```
- Request
```
{
    "data": {
        "type": "products",
        "attributes": {
            "code": "999001",
            "name": "B-ED 999 001",
            "description": "B-ED 999 001"
        }
    }
}
```

- Response with `201`
```
{
    "data": {
        "type": "products",
        "id": "3347",
        "attributes": {
            "code": "999001",
            "name": "B-ED 999 001",
            "on_hand": null,
            "description": "B-ED 999 001",
            "created_at": "2021-05-22 02:51:16",
            "updated_at": "2021-05-22 02:51:16",
            "deleted_at": ""
        },
        "relationships": {
            "stocks": {
                "data": []
            }
        }
    }
}
```

- Response with `422`
```
{
    "errors": [
        {
            "status": "422",
            "title": "Unprocessable Entity",
            "detail": "The code field is required.",
            "source": {
                "pointer": "/data"
            }
        }
    ]
}
```

#### Product get
```
> GET /premex-api/v1/products/3348
```

- Response with `200`
```
{
    "data": {
        "type": "products",
        "id": "3348",
        "attributes": {
            "code": "999001",
            "name": "B-ED 999 001",
            "on_hand": 22,
            "description": "B-ED 999 001",
            "created_at": "2021-05-22 03:00:07",
            "updated_at": "2021-05-22 03:00:30",
            "deleted_at": ""
        },
        "relationships": {
            "stocks": {
                "data": [
                    {
                        "type": "stocks",
                        "id": "7272"
                    },
                    {
                        "type": "stocks",
                        "id": "7273"
                    }
                ]
            }
        }
    }
}
```

#### Product get with including stocks
```
> GET /premex-api/v1/products/3348?include=stocks
```

- Response with `200`
```
{
    "data": {
        "type": "products",
        "id": "3348",
        "attributes": {
            "code": "999001",
            "name": "B-ED 999 001",
            "on_hand": 22,
            "description": "B-ED 999 001",
            "created_at": "2021-05-22 03:00:07",
            "updated_at": "2021-05-22 03:00:30",
            "deleted_at": ""
        },
        "relationships": {
            "stocks": {
                "data": [
                    {
                        "type": "stocks",
                        "id": "7272"
                    },
                    {
                        "type": "stocks",
                        "id": "7273"
                    }
                ]
            }
        }
    },
    "included": [
        {
            "type": "stocks",
            "id": "7272",
            "attributes": {
                "on_hand": "11",
                "taken": "0",
                "production_date": "2020-05-20",
                "created_at": "2021-05-22 03:00:26",
                "updated_at": "2021-05-22 03:00:26"
            },
            "relationships": {
                "products": {
                    "data": {
                        "type": "products",
                        "id": "3348"
                    }
                }
            }
        },
        {
            "type": "stocks",
            "id": "7273",
            "attributes": {
                "on_hand": "11",
                "taken": "0",
                "production_date": "2020-05-20",
                "created_at": "2021-05-22 03:00:30",
                "updated_at": "2021-05-22 03:00:30"
            },
            "relationships": {
                "products": {
                    "data": {
                        "type": "products",
                        "id": "3348"
                    }
                }
            }
        }
    ]
}
```

#### Product stocks get
```
> GET /premex-api/v1/products/3348/stocks
```

- Response with `200`
```
{
    "data": [
        {
            "type": "stocks",
            "id": "7272",
            "attributes": {
                "on_hand": "11",
                "taken": "0",
                "production_date": "2020-05-20",
                "created_at": "2021-05-22 03:00:26",
                "updated_at": "2021-05-22 03:00:26"
            },
            "relationships": {
                "products": {
                    "data": {
                        "type": "products",
                        "id": "3348"
                    }
                }
            }
        },
        {
            "type": "stocks",
            "id": "7273",
            "attributes": {
                "on_hand": "11",
                "taken": "0",
                "production_date": "2020-05-20",
                "created_at": "2021-05-22 03:00:30",
                "updated_at": "2021-05-22 03:00:30"
            },
            "relationships": {
                "products": {
                    "data": {
                        "type": "products",
                        "id": "3348"
                    }
                }
            }
        }
    ]
}
```










## Built With

Detail any key frameworks or libraries

- [laravel 8](https://laravel.com)
- [laravel JSON:API plugin](https://laravel-json-api.readthedocs.io/en/latest/)







