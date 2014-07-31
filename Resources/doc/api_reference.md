TmsFaqBundle Api Reference
==========================

API List
--------

### Faq
| Method | Path                                        | Description
|--------|---------------------------------------------|------------
| GET    | [/faqs.{_format}](api/faq/get_faqs.md)      | List all faqs
| GET    | [/faqs/{id}.{_format}](api/faq/get_faq.md)  | Retrieve one faq
| GET    | [/faqs/{id}/questions.{_format}](api/faq/get_faq_questions.md) | Retrieve Faq questions
| GET    | [/faqs/{id}/questioncategories.{_format}](api/faq/get_faq_questioncategories.md) | Retrieve Faq question categories

### Question category
| Method | Path                                                                         | Description
|--------|------------------------------------------------------------------------------|------------
| GET    | [/faq/questioncategories](api/questioncategory/get_questioncategories.md)    | List all question categories
| GET    | [/faq/questioncategories/{id}](api/questioncategory/get_questioncategory.md) | Retrieve one question category
| GET    | [/faq/questioncategories/{id}/faq.{_format}](api/questioncategory/get_questioncategory_faq.md) | Retrieve question category Faq
| GET    | [/faq/questioncategories/{id}/questions.{_format}](api/questioncategory/get_questioncategory_questions.md) | Retrieve question category questions

### Question
| Method | Path                                                                  | Description
|--------|-----------------------------------------------------------------------|------------
| GET    | [/faq/questions](api/question/get_questions.md)                       | List all questions
| GET    | [/faq/questions/{id}](api/question/get_question.md)                   | Retrieve one question
| GET    | [/faq/questions/{id}/faq.{_format}](api/question/get_question_faq.md) | Retrieve Question Faq
| GET    | [/faq/questions/{id}/questioncategories.{_format}](api/question/get_question_questioncategories.md) | Retrieve Question question categories
| GET    | [/faq/questions/{id}/evaluations.{_format}](api/question/get_question_evaluations.md) | Retrieve Question evaluations
| PATCH  | [/questions/{id}/yepnope/{value}](api/question/patch_question_yepnope.md) | Update partially a question (countYep or countNope parameters)

### Evaluation
| Method | Path                                                      | Description
|--------|-----------------------------------------------------------|------------
| GET    | [/faq/evaluations](api/evaluation/get_evaluations.md)     | List all evaluations
| GET    | [/faq/evaluations/{id}](api/evaluation/get_evaluation.md) | Retrieve one evaluation
| GET    | [/faq/evaluations/{id}/question.{_format}](api/evaluation/get_evaluation_question.md) | Retrieve evaluation question
| POST   | [/faq/evaluations](api/evaluation/post_evaluation.md)    | Create an evaluation
