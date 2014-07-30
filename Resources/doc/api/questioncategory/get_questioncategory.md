TmsFaqBundle API: [GET] Question category
=========================================

Retrieve one question category


## General
|             | Values
|-------------|-------
| **Method**  | GET
| **Path**    | /faq/questioncategories/{id}.{_format}
| **Formats** | json|xml
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
        "type": "Tms\\Bundle\\FaqBundle\\Entity\\QuestionCategory",
        "serializerContextGroup": "tms_rest.item"
    },
    "data": {
        "id": 20,
        "name": "Votre participation",
        "slug": "votre-participation"
    },
    "links": {
        "self": {
            "rel": "self",
            "href": "http://operation-manager.tessi/app_dev.php/api/faq/questioncategories/20"
        },
        "embeddeds": {
            "faq": {
                "rel": "embedded",
                "href": "http://operation-manager.tessi/app_dev.php/api/faq/questioncategories/20/faq"
            },
            "questions": {
                "rel": "embedded",
                "href": "http://operation-manager.tessi/app_dev.php/api/faq/questioncategories/20/questions"
            }
        }
    },
    "actions": []
}
```

### xml
```xml
<?xml version="1.0" encoding="UTF-8"?>
<result>
    <entry>
        <entry>
            <![CDATA[Tms\Bundle\FaqBundle\Entity\QuestionCategory]]>
        </entry>
        <entry>
            <![CDATA[tms_rest.item]]>
        </entry>
    </entry>
    <entry>
        <id>20</id>
        <name>
            <![CDATA[Votre participation]]>
        </name>
        <slug>
            <![CDATA[votre-participation]]>
        </slug>
    </entry>
    <entry>
        <entry>
            <entry>
                <![CDATA[self]]>
            </entry>
            <entry>
                <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questioncategories/20.xml]]>
            </entry>
        </entry>
        <entry>
            <entry>
                <entry>
                    <![CDATA[embedded]]>
                </entry>
                <entry>
                    <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questioncategories/20/faq.xml]]>
                </entry>
            </entry>
            <entry>
                <entry>
                    <![CDATA[embedded]]>
                </entry>
                <entry>
                    <![CDATA[http://operation-manager.tessi/app_dev.php/api/faq/questioncategories/20/questions.xml]]>
                </entry>
            </entry>
        </entry>
    </entry>
    <entry/>
</result>
```