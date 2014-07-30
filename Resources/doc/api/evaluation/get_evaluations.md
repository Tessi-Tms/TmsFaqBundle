TmsFaqBundle API: [GET] Evaluations
===================================

List all evaluations

## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /evaluations
| **Formats** | json
| **Secured** | false

## HTTP Request parameters
| Name        | Optional | Default | Requirements | Description
|-------------|----------|---------|--------------|------------
| question_id | true     |         | \d+          | Id of the question associated with evaluations
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
        "type":"Tms\\Bundle\\FaqBundle\\Entity\\Evaluation",
        "serializerContextGroup":"tms_rest.collection",
        "page":1,
        "pageCount":2,
        "totalCount":2,
        "limit":20,
        "offset":0
    },
    "data": [
        {
            "metadata": {
                "type":"Tms\\Bundle\\FaqBundle\\Entity\\Evaluation",
                "serializerContextGroup":"tms_rest.item"
            },
            "data": {
                "id":1,
                "value":5,
                "createdAt":"2014-07-17T00:00:00+0200"
            },
            "links": {
                "self": {
                    "rel":"self",
                    "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/evaluations\/1.json"
                }
            },
            "actions":[]
        },
        {
            "metadata": {
                "type":"Tms\\Bundle\\FaqBundle\\Entity\\Evaluation",
                "serializerContextGroup":"tms_rest.item"
            },
            "data": {
                "id":2,
                "value":4,
                "createdAt":"2014-07-16T04:24:11+0200"
            },
            "links": {
                "self": {
                    "rel":"self",
                    "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/evaluations\/2.json"
                }
            },
            "actions":[]
        }
    ],
    "links": {
        "self": {
            "rel":"self",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/evaluations?page=1&limit=20&offset=0"
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
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/evaluations?page=1&limit=20&offset=0"
        },
        "lastPage": {
            "rel":"nav",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/evaluations?page=1&limit=20&offset=0"
        }
    },
    "actions":[]
}
```