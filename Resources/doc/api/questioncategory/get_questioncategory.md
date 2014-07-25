TmsFaqBundle API: [GET] Question category
=========================================

Retrieve one question category


## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /questioncategories/{id}
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
        "type":"Tms\\Bundle\\FaqBundle\\Entity\\QuestionCategory",
        "serializerContextGroup":"tms_rest.item"
    },
    "data": {
        "id":9,
        "name":"Toto",
        "slug":"toto"
    },
    "links": {
        "self": {
            "rel":"self",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/questioncategories\/9"
        }
    },
    "actions":[]
}
```