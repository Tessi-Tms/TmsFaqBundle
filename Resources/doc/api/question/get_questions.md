TmsFaqBundle API: [GET] Questions
=================================

List all questions

## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /questions
| **Formats** | json
| **Secured** | false

## HTTP Request parameters
| Name                 | Optional | Default | Requirements | Description
|----------------------|----------|---------|--------------|------------
| faq_id               | true     |         | \d+          | Id of the Faq associated with questions
| question_category_id | true     |         | \d+          | Id of the question category associated with questions
| limit                | true     | 20      | \d+          | Pagination limit
| offset               | true     | 0       | \d+          | Pagination offet
| page                 | true     |         |              |
| sort                 | true     |         |              |

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
        "type":"Tms\\Bundle\\FaqBundle\\Entity\\Question",
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
                "type":"Tms\\Bundle\\FaqBundle\\Entity\\Question",
                "serializerContextGroup":"tms_rest.item"
            },
            "data": {
                "id":5,
                "question":"test1",
                "answer":"test1",
                "average":0,
                "countYep":0,
                "countNope":0
            },
            "links": {
                "self": {
                    "rel":"self",
                    "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/questions\/5.json"
                }
            },
            "actions":[]
        },
        {
            "metadata": {
                "type":"Tms\\Bundle\\FaqBundle\\Entity\\Question",
                "serializerContextGroup":"tms_rest.item"
            },
            "data": {
                "id":6,
                "question":"test2",
                "answer":"test2",
                "average":0,
                "countYep":0,
                "countNope":0
            },
            "links":{
                "self": {
                    "rel":"self",
                    "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/questions\/6.json"
                }
            },
            "actions":[]
        }
    ],
    "links": {
        "self": {
            "rel":"self",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/questions?page=1&limit=20&offset=0"
        },
        "nextPage": {
            "rel":"nav","href":""
        },
        "previousPage": {
            "rel":"nav",
            "href":""
        },
        "firstPage": {
            "rel":"nav",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/questions?page=1&limit=20&offset=0"
        },
        "lastPage": {
            "rel":"nav",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/questions?page=1&limit=20&offset=0"
        }
    },
    "actions":[]
}
```