TmsFaqBundle API: [PATCH] Question yep or nope
==============================================

Update partially Question (field yep or nope)

## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /questions/{id}/yepnope/{value}.{_format}
| **Formats** | json, xml
| **Secured** | false

## HTTP Request parameters
No request parameters

## Parameter path
| Name   | Optional | Default | Requirements | Description
|--------|----------|---------|--------------|------------
| id     | false    |         | \d+          | Question id
| value  | false    |         | yep or nope  | CountYep or countNope value

## HTTP Response codes
| Code | Description
|------|------------
| 200  | Ok
| 404  | Not found
| 500  | Server error
