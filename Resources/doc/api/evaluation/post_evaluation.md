TmsFaqBundle API: [POST] Evaluation
===================================

Create one evaluation


## General
|             | Values
|-------------|-------
| **Method**  | POST
| **Path**    | /faq/evaluations
| **Formats** | json, xml
| **Secured** | false

## HTTP Request parameters
| Name        | Optional | Default | Requirements | Description
|-------------|----------|---------|--------------|------------
| value       | false    |         | \d+          | Evaluation value
| question_id | false    |         | \d+          | Id of the question associated with evaluations

## HTTP Response codes
| Code | Description
|------|------------
| 200  | Ok
| 404  | Not found (wrong id)
| 400  | Bad request
| 500  | Server error
