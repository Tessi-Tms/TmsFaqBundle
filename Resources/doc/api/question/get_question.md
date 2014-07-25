TmsFaqBundle API: [GET] Question
================================

Retrieve one question


## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /questions/{id}
| **Formats** | json
| **Secured** | false

## HTTP Request parameters
No request parameters

## HTTP Response codes
| Code | Description
|------|------------
| 200  | Ok
| 404  | Not found (wrong id)
| 500  | Server error

### json
```json
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
        "self":{
            "rel":"self",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/questions\/5"
        }
    },
    "actions":[]
}
```