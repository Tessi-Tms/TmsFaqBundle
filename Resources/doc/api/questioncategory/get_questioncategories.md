TmsFaqBundle API: [GET] Question categories
===========================================

List all question categories

## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /questioncategories
| **Formats** | json
| **Secured** | false

## HTTP Request parameters
| Name     | Optional | Default | Requirements | Description
|----------|----------|---------|--------------|------------
| faq_id   | true     |         | \d+          | Id of the Faq associated with question categories
| limit    | true     | 20      | \d+          | Pagination limit
| offset   | true     | 0       | \d+          | Pagination offet
| page     | true     |         |              |
| sort     | true     |         |              |

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
        "type":"Tms\\Bundle\\FaqBundle\\Entity\\QuestionCategory",
        "serializerContextGroup":"tms_rest.collection",
        "page":1,
        "pageCount":2,
        "totalCount":2,
        "limit":20,
        "offset":0
    },
    "data":[
        {
            "metadata": {
                "type":"Tms\\Bundle\\FaqBundle\\Entity\\QuestionCategory",
                "serializerContextGroup":"tms_rest.item"
            },
            "data": {
                "id":7,
                "name":"test1",
                "slug":"test1"
            },
            "links": {
                "self": {
                    "rel":"self",
                    "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/questioncategories\/7.json"
                }
            },
            "actions":[]
        },
        {
            "metadata": {
                "type":"Tms\\Bundle\\FaqBundle\\Entity\\QuestionCategory",
                "serializerContextGroup":"tms_rest.item"
            },
            "data": {
                "id":9,
                "name":"test2",
                "slug":"test2"
            },
            "links": {
                "self": {
                    "rel":"self",
                    "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/questioncategories\/9.json"
                }
            },
            "actions":[]
        }
    ],
    "links": {
        "self":{
            "rel":"self",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/questioncategories?page=1&limit=20&offset=0"
        },
        "nextPage": {
            "rel":"nav",
            "href":""
        },
        "previousPage": {
            "rel":"nav",
            "href":""
        },
        "firstPage": {
            "rel":"nav",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/questioncategories?page=1&limit=20&offset=0"
        },
        "lastPage": {
            "rel":"nav",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/questioncategories?page=1&limit=20&offset=0"
        }
    },
    "actions":[]
}
```