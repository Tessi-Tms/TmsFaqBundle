TmsFaqBundle API: [GET] Evaluation
==================================.

Retrieve one evaluation


## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /evaluations/{id}
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
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/evaluations\/2"
        }
    },
    "actions":[]
}
```