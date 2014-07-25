TmsFaqBundle API: [GET] Faq
===========================

Retrieve one Faq


## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /faqs/{id}
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
        "type":"Tms\\Bundle\\FaqBundle\\Entity\\Faq",
        "serializerContextGroup":"tms_rest.item"
    },
    "data": {
        "id":5,
        "title":"test",
        "enabled":true,
        "customerId":"123456"
    },
    "links": {
        "self":{
            "rel":"self",
            "href":"http:\/\/operation-manager.tessi\/app_dev.php\/api\/faqs\/5"
        }
    },
    "actions":[]
}
```