TmsFaqBundle API: [GET] Faqs
============================

List all Faqs

## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /faqs
| **Formats** | json
| **Secured** | false

## HTTP Request parameters
| Name        | Optional | Default | Requirements | Description
|-------------|----------|---------|--------------|------------
| customer_id | true     |         | \d+          | Id of a customer associated with a Faq
| limit       | true     | 20      | \d+          | Pagination limit
| offset      | true     | 0       | \d+          | Pagination offet
| page        | true     |         |              |
| sort        | true     |         |              |

## HTTP Response codes
| Code | Description
|------|------------
| 200  | Ok
| 400  | Bad request (wrong query parameters)
| 500  | Server error

## HTTP Response content examples

### json
```json
{
    "metadata": {
        "type":"Tms\\Bundle\\FaqBundle\\Entity\\Faq",
        "serializerContextGroup":"tms_rest.collection",
        "page":1,
        "pageCount":2,
        "totalCount":3,
        "limit":2,
        "offset":0
    },
    "data": [
        {
            "metadata": {
                "type":"Tms\\Bundle\\FaqBundle\\Entity\\Faq",
                "serializerContextGroup":"tms_rest.item"
            },
            "data": {
                "id":5,
                "title":"test1",
                "enabled":true,
                "customerId":"123"
            },
            "links": {
                "self": {
                    "rel":"self",
                    "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/faqs\/5.json"
                }
            },
            "actions":[]
        },
        {
            "metadata": {
                "type":"Tms\\Bundle\\FaqBundle\\Entity\\Faq",
                "serializerContextGroup":"tms_rest.item"
            },
            "data": {
                "id":7,
                "title":"test2",
                "enabled":true,
                "customerId":"456"
            },
            "links": {
                "self": {
                    "rel":"self",
                    "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/faqs\/7.json"
                }
            },
            "actions":[]
        }
    ],
    "links": {
        "self": {
            "rel":"self",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/faqs?page=1&limit=2&offset=0"
        },
        "nextPage": {
            "rel":"nav",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/faqs?page=2&limit=2&offset=0"
        },
        "previousPage": {
            "rel":"nav",
            "href":""
        },
        "firstPage": {
            "rel":"nav",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/faqs?page=1&limit=2&offset=0"
        },
        "lastPage": {
            "rel":"nav",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/faqs?page=2&limit=2&offset=0"
        }
    },
    "actions":[]
}
```